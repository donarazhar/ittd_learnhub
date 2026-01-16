<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Config\Config;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use ZipArchive;
use Carbon\Carbon;

class BackupController extends Controller
{
    /**
     * Display backup list and status.
     */
    public function index()
    {
        try {
            $backups = $this->getBackupFiles();
            $backupStatuses = $this->getBackupStatuses();
            $statistics = $this->getBackupStatistics($backups);
            $scheduleInfo = $this->getScheduleInfo();

            return view('admin.backups.index', compact(
                'backups',
                'backupStatuses',
                'statistics',
                'scheduleInfo'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading backup page: ' . $e->getMessage());

            return view('admin.backups.index', [
                'backups' => [],
                'backupStatuses' => [],
                'statistics' => $this->getDefaultStatistics(),
                'scheduleInfo' => $this->getScheduleInfo()
            ])->with('error', 'Terjadi kesalahan saat memuat data backup.');
        }
    }

    /**
     * Create new backup.
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required|in:full,db,files'
        ]);

        $type = $request->input('type');
        $typeLabels = [
            'full' => 'Full Backup (Database + Files)',
            'db' => 'Database Only',
            'files' => 'Files Only'
        ];

        try {
            // Log start
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['type' => $type])
                ->log("Memulai proses backup: {$typeLabels[$type]}");

            // Run backup based on type
            $output = $this->runBackup($type);

            // Log success
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'type' => $type,
                    'output' => $output,
                    'size' => $this->getLatestBackupSize()
                ])
                ->log("Berhasil membuat backup: {$typeLabels[$type]}");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', "Backup berhasil dibuat! ({$typeLabels[$type]})");
        } catch (\Exception $e) {
            Log::error("Backup creation failed ({$type}): " . $e->getMessage());

            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'type' => $type,
                    'error' => $e->getMessage()
                ])
                ->log("Gagal membuat backup: {$typeLabels[$type]}");

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
            $disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
            $filePath = config('backup.backup.name') . '/' . $file;

            if (!$disk->exists($filePath)) {
                return redirect()
                    ->route('admin.backups.index')
                    ->with('error', 'File backup tidak ditemukan.');
            }

            // Log download
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'file' => $file,
                    'size' => $this->formatBytes($disk->size($filePath))
                ])
                ->log("Mendownload backup: {$file}");

            return $disk->download($filePath);
        } catch (\Exception $e) {
            Log::error('Error downloading backup: ' . $e->getMessage());

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal mendownload backup: ' . $e->getMessage());
        }
    }

    /**
     * Delete specific backup file.
     */
    public function destroy($file)
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
            $filePath = config('backup.backup.name') . '/' . $file;

            if (!$disk->exists($filePath)) {
                return redirect()
                    ->route('admin.backups.index')
                    ->with('error', 'File backup tidak ditemukan.');
            }

            $fileSize = $this->formatBytes($disk->size($filePath));

            // Delete file
            $disk->delete($filePath);

            // Log deletion
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'file' => $file,
                    'size' => $fileSize
                ])
                ->log("Menghapus backup: {$file}");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', 'Backup berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting backup: ' . $e->getMessage());

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal menghapus backup: ' . $e->getMessage());
        }
    }

    /**
     * Clean old backups according to retention policy.
     */
    public function clean()
    {
        try {
            // Count backups before cleanup
            $beforeCount = $this->countBackupFiles();

            // Log start
            activity()
                ->causedBy(auth()->user())
                ->log("Memulai cleanup backup lama");

            // Run cleanup
            Artisan::call('backup:clean');
            $output = Artisan::output();

            // Count backups after cleanup
            $afterCount = $this->countBackupFiles();
            $deletedCount = $beforeCount - $afterCount;

            // Log success
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'before_count' => $beforeCount,
                    'after_count' => $afterCount,
                    'deleted_count' => $deletedCount,
                    'output' => $output
                ])
                ->log("Berhasil cleanup {$deletedCount} backup lama");

            return redirect()
                ->route('admin.backups.index')
                ->with('success', "Cleanup berhasil! {$deletedCount} backup lama telah dihapus.");
        } catch (\Exception $e) {
            Log::error('Error cleaning backups: ' . $e->getMessage());

            activity()
                ->causedBy(auth()->user())
                ->withProperties(['error' => $e->getMessage()])
                ->log("Gagal cleanup backup");

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal membersihkan backup: ' . $e->getMessage());
        }
    }

    /**
     * Monitor backup health and return status.
     */
    public function monitor()
    {
        try {
            Artisan::call('backup:monitor');
            $output = Artisan::output();

            $backupStatuses = $this->getBackupStatuses();
            $allHealthy = collect($backupStatuses)->every(fn($status) => $status['healthy']);

            return response()->json([
                'success' => true,
                'healthy' => $allHealthy,
                'statuses' => $backupStatuses,
                'output' => $output,
                'timestamp' => now()->toDateTimeString()
            ]);
        } catch (\Exception $e) {
            Log::error('Error monitoring backups: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get detailed backup information.
     */
    public function show($file)
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
            $filePath = config('backup.backup.name') . '/' . $file;

            if (!$disk->exists($filePath)) {
                return redirect()
                    ->route('admin.backups.index')
                    ->with('error', 'File backup tidak ditemukan.');
            }

            $backupInfo = [
                'name' => basename($file),
                'path' => $filePath,
                'size' => $this->formatBytes($disk->size($filePath)),
                'size_bytes' => $disk->size($filePath),
                'date' => Carbon::createFromTimestamp($disk->lastModified($filePath)),
                'type' => $this->detectBackupType($file),
                'contents' => $this->getBackupContents($disk->path($filePath))
            ];

            return view('admin.backups.show', compact('backupInfo', 'file'));
        } catch (\Exception $e) {
            Log::error('Error showing backup details: ' . $e->getMessage());

            return redirect()
                ->route('admin.backups.index')
                ->with('error', 'Gagal memuat detail backup.');
        }
    }

    /**
     * Restore backup (if restoration feature is needed).
     */
    public function restore(Request $request, $file)
    {
        // Note: Restoration is complex and risky - implement with extreme caution
        // This is a placeholder for future implementation

        return redirect()
            ->route('admin.backups.index')
            ->with('warning', 'Fitur restore belum tersedia. Silakan restore manual dari file backup.');
    }

    /**
     * Run backup based on type.
     */
    protected function runBackup($type)
    {
        switch ($type) {
            case 'db':
                Artisan::call('backup:run', ['--only-db' => true]);
                break;
            case 'files':
                Artisan::call('backup:run', ['--only-files' => true]);
                break;
            default:
                Artisan::call('backup:run');
                break;
        }

        return Artisan::output();
    }

    /**
     * Get all backup files with details.
     */
    protected function getBackupFiles()
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
            $backupName = config('backup.backup.name');
            $files = $disk->files($backupName);

            $backups = [];
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'zip') {
                    $backups[] = [
                        'path' => $file,
                        'name' => basename($file),
                        'size' => $this->formatBytes($disk->size($file)),
                        'size_bytes' => $disk->size($file),
                        'date' => $disk->lastModified($file),
                        'date_formatted' => Carbon::createFromTimestamp($disk->lastModified($file))->format('d M Y, H:i'),
                        'date_human' => Carbon::createFromTimestamp($disk->lastModified($file))->diffForHumans(),
                        'type' => $this->detectBackupType(basename($file)),
                        'age_days' => Carbon::createFromTimestamp($disk->lastModified($file))->diffInDays(now())
                    ];
                }
            }

            // Sort by date descending
            usort($backups, fn($a, $b) => $b['date'] - $a['date']);

            return $backups;
        } catch (\Exception $e) {
            Log::error('Error fetching backup files: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get backup statuses using Spatie Backup.
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
                    'newest_date' => $backupDestination->newestBackup()?->date(),
                    'oldest' => $backupDestination->oldestBackup()?->date()->diffForHumans(),
                    'used_storage' => $this->formatBytes($backupDestination->usedStorage()),
                    'used_storage_bytes' => $backupDestination->usedStorage(),
                ];
            }

            return $statuses;
        } catch (\Exception $e) {
            Log::error('Error getting backup statuses: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get backup statistics.
     */
    protected function getBackupStatistics($backups)
    {
        $totalSize = collect($backups)->sum('size_bytes');
        $averageSize = count($backups) > 0 ? $totalSize / count($backups) : 0;

        return [
            'total_count' => count($backups),
            'total_size' => $this->formatBytes($totalSize),
            'total_size_bytes' => $totalSize,
            'average_size' => $this->formatBytes($averageSize),
            'latest_backup' => !empty($backups) ? $backups[0]['date_human'] : 'N/A',
            'oldest_backup' => !empty($backups) ? end($backups)['date_human'] : 'N/A',
            'db_only_count' => collect($backups)->filter(fn($b) => $b['type'] === 'Database Only')->count(),
            'files_only_count' => collect($backups)->filter(fn($b) => $b['type'] === 'Files Only')->count(),
            'full_backup_count' => collect($backups)->filter(fn($b) => $b['type'] === 'Full Backup')->count(),
        ];
    }

    /**
     * Get default statistics when data unavailable.
     */
    protected function getDefaultStatistics()
    {
        return [
            'total_count' => 0,
            'total_size' => '0 B',
            'total_size_bytes' => 0,
            'average_size' => '0 B',
            'latest_backup' => 'N/A',
            'oldest_backup' => 'N/A',
            'db_only_count' => 0,
            'files_only_count' => 0,
            'full_backup_count' => 0,
        ];
    }

    /**
     * Get schedule information.
     */
    protected function getScheduleInfo()
    {
        return [
            [
                'name' => 'Backup Database Harian',
                'schedule' => 'Setiap hari pukul 02:00 WIB',
                'description' => 'Otomatis backup database',
                'type' => 'db',
                'icon' => 'database',
                'color' => 'blue'
            ],
            [
                'name' => 'Backup Full Mingguan',
                'schedule' => 'Setiap Minggu pukul 03:00 WIB',
                'description' => 'Backup database + files',
                'type' => 'full',
                'icon' => 'server',
                'color' => 'green'
            ],
            [
                'name' => 'Cleanup Otomatis',
                'schedule' => 'Setiap hari pukul 04:00 WIB',
                'description' => 'Hapus backup lama sesuai retention policy',
                'type' => 'clean',
                'icon' => 'trash',
                'color' => 'yellow'
            ],
            [
                'name' => 'Health Monitor',
                'schedule' => 'Setiap hari pukul 08:00 WIB',
                'description' => 'Cek status backup dan kirim notifikasi',
                'type' => 'monitor',
                'icon' => 'heart',
                'color' => 'red'
            ]
        ];
    }

    /**
     * Detect backup type from filename.
     */
    protected function detectBackupType($filename)
    {
        if (str_contains($filename, 'db-only') || str_contains($filename, 'database-only')) {
            return 'Database Only';
        } elseif (str_contains($filename, 'files-only')) {
            return 'Files Only';
        } else {
            return 'Full Backup';
        }
    }

    /**
     * Get backup file contents list (ZIP entries).
     */
    protected function getBackupContents($zipPath)
    {
        try {
            $zip = new ZipArchive();
            if ($zip->open($zipPath) === true) {
                $contents = [];
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $stat = $zip->statIndex($i);
                    $contents[] = [
                        'name' => $stat['name'],
                        'size' => $this->formatBytes($stat['size']),
                        'compressed_size' => $this->formatBytes($stat['comp_size']),
                    ];
                }
                $zip->close();
                return $contents;
            }
            return [];
        } catch (\Exception $e) {
            Log::error('Error reading ZIP contents: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Count total backup files.
     */
    protected function countBackupFiles()
    {
        try {
            $disk = Storage::disk(config('backup.backup.destination.disks')[0] ?? 'local');
            $files = $disk->files(config('backup.backup.name'));
            return collect($files)->filter(fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'zip')->count();
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get latest backup size.
     */
    protected function getLatestBackupSize()
    {
        try {
            $backups = $this->getBackupFiles();
            return !empty($backups) ? $backups[0]['size'] : 'N/A';
        } catch (\Exception $e) {
            return 'N/A';
        }
    }

    /**
     * Format bytes to human readable format.
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
