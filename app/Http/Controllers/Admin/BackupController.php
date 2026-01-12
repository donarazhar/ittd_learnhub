<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\Config\Config;

class BackupController extends Controller
{
    /**
     * Display backup list.
     */
    public function index()
    {
        $backups = [];
        
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $files = $disk->files(config('backup.backup.name'));
            
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'zip') {
                    $backups[] = [
                        'path' => $file,
                        'name' => basename($file),
                        'size' => $this->formatBytes($disk->size($file)),
                        'date' => $disk->lastModified($file),
                        'date_formatted' => date('d M Y, H:i', $disk->lastModified($file)),
                    ];
                }
            }
            
            // Sort by date descending
            usort($backups, function($a, $b) {
                return $b['date'] - $a['date'];
            });
        } catch (\Exception $e) {
            \Log::error('Error fetching backups: ' . $e->getMessage());
        }

        // Get backup status
        $backupStatuses = $this->getBackupStatuses();

        return view('admin.backups.index', compact('backups', 'backupStatuses'));
    }

    /**
     * Create new backup.
     */
    public function create(Request $request)
    {
        $type = $request->input('type', 'full');

        try {
            activity()
                ->causedBy(auth()->user())
                ->log(auth()->user()->name . " memulai proses backup ({$type})");

            if ($type === 'db') {
                Artisan::call('backup:run', ['--only-db' => true]);
            } elseif ($type === 'files') {
                Artisan::call('backup:run', ['--only-files' => true]);
            } else {
                Artisan::call('backup:run');
            }

            $output = Artisan::output();

            activity()
                ->causedBy(auth()->user())
                ->withProperties(['output' => $output])
                ->log(auth()->user()->name . " berhasil membuat backup ({$type})");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', 'Backup berhasil dibuat!');

        } catch (\Exception $e) {
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['error' => $e->getMessage()])
                ->log(auth()->user()->name . " gagal membuat backup ({$type})");

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    /**
     * Download backup file.
     */
    public function download($file)
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $filePath = config('backup.backup.name') . '/' . $file;

            if (!$disk->exists($filePath)) {
                abort(404, 'Backup file not found');
            }

            activity()
                ->causedBy(auth()->user())
                ->withProperties(['file' => $file])
                ->log(auth()->user()->name . " mendownload backup: {$file}");

            return $disk->download($filePath);

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal mendownload backup: ' . $e->getMessage());
        }
    }

    /**
     * Delete backup file.
     */
    public function destroy($file)
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
            $filePath = config('backup.backup.name') . '/' . $file;

            if (!$disk->exists($filePath)) {
                abort(404, 'Backup file not found');
            }

            $disk->delete($filePath);

            activity()
                ->causedBy(auth()->user())
                ->withProperties(['file' => $file])
                ->log(auth()->user()->name . " menghapus backup: {$file}");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', 'Backup berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal menghapus backup: ' . $e->getMessage());
        }
    }

    /**
     * Clean old backups.
     */
    public function clean()
    {
        try {
            activity()
                ->causedBy(auth()->user())
                ->log(auth()->user()->name . " memulai cleanup backup lama");

            Artisan::call('backup:clean');
            $output = Artisan::output();

            activity()
                ->causedBy(auth()->user())
                ->withProperties(['output' => $output])
                ->log(auth()->user()->name . " berhasil cleanup backup lama");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', 'Backup lama berhasil dibersihkan!');

        } catch (\Exception $e) {
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['error' => $e->getMessage()])
                ->log(auth()->user()->name . " gagal cleanup backup");

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal membersihkan backup: ' . $e->getMessage());
        }
    }

    /**
     * Monitor backup health.
     */
    public function monitor()
    {
        try {
            Artisan::call('backup:monitor');
            $output = Artisan::output();

            $backupStatuses = $this->getBackupStatuses();

            return response()->json([
                'success' => true,
                'output' => $output,
                'statuses' => $backupStatuses,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get backup statuses.
     */
    protected function getBackupStatuses()
    {
        try {
            $statuses = [];
            $config = Config::fromArray(config('backup'));
            
            foreach ($config->monitoredBackups as $monitoredBackup) {
                $backupDestination = BackupDestination::create(
                    $monitoredBackup->disks[0],
                    $monitoredBackup->name
                );

                $backupDestinationStatus = BackupDestinationStatusFactory::createForMonitorConfig($monitoredBackup)
                    ->getBackupDestinationStatus();

                $statuses[] = [
                    'name' => $monitoredBackup->name,
                    'disk' => $monitoredBackup->disks[0],
                    'reachable' => $backupDestination->isReachable(),
                    'healthy' => $backupDestinationStatus->isHealthy(),
                    'amount' => $backupDestination->backups()->count(),
                    'newest' => $backupDestination->newestBackup()?->date()->diffForHumans(),
                    'used_storage' => $this->formatBytes($backupDestination->usedStorage()),
                ];
            }

            return $statuses;

        } catch (\Exception $e) {
            \Log::error('Error getting backup statuses: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Format bytes to human readable.
     */
    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}