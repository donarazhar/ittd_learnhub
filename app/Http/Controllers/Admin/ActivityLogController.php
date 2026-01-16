<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs with advanced filtering.
     */
    public function index(Request $request)
    {
        try {
            $query = Activity::with(['causer', 'subject'])
                ->latest();

            // Filter by log name
            if ($request->filled('log_name')) {
                $query->where('log_name', $request->log_name);
            }

            // Filter by event
            if ($request->filled('event')) {
                $query->where('event', $request->event);
            }

            // Filter by causer (user)
            if ($request->filled('user_id')) {
                $query->where('causer_id', $request->user_id)
                    ->where('causer_type', 'App\Models\User');
            }

            // Filter by subject type
            if ($request->filled('subject_type')) {
                $query->where('subject_type', $request->subject_type);
            }

            // Filter by date range
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            // Search in description and properties
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhereJsonContains('properties', $search);
                });
            }

            // Pagination
            $perPage = $request->input('per_page', 50);
            $activities = $query->paginate($perPage)->withQueryString();

            // Get unique log names for filter dropdown
            $logNames = Activity::select('log_name')
                ->distinct()
                ->orderBy('log_name')
                ->pluck('log_name');

            // Get unique events for filter dropdown
            $events = Activity::select('event')
                ->distinct()
                ->whereNotNull('event')
                ->orderBy('event')
                ->pluck('event');

            // Get unique subject types for filter dropdown
            $subjectTypes = Activity::select('subject_type')
                ->distinct()
                ->whereNotNull('subject_type')
                ->orderBy('subject_type')
                ->pluck('subject_type')
                ->map(function ($type) {
                    return [
                        'full' => $type,
                        'short' => class_basename($type)
                    ];
                });

            return view('admin.activity-logs.index', compact(
                'activities',
                'logNames',
                'events',
                'subjectTypes'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading activity logs: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat memuat activity logs.');
        }
    }

    /**
     * Show single activity log detail.
     */
    public function show(Activity $activity)
    {
        try {
            $activity->load(['causer', 'subject']);

            // Get related activities (same subject or batch)
            $relatedActivities = Activity::where(function ($query) use ($activity) {
                $query->where('subject_type', $activity->subject_type)
                    ->where('subject_id', $activity->subject_id);

                if ($activity->batch_uuid) {
                    $query->orWhere('batch_uuid', $activity->batch_uuid);
                }
            })
                ->where('id', '!=', $activity->id)
                ->latest()
                ->limit(10)
                ->get();

            return view('admin.activity-logs.show', compact('activity', 'relatedActivities'));
        } catch (\Exception $e) {
            Log::error('Error showing activity log detail: ' . $e->getMessage());

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('error', 'Activity log tidak ditemukan.');
        }
    }

    /**
     * Clean old activity logs based on age.
     */
    public function clean(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:3650'
        ]);

        try {
            DB::beginTransaction();

            $days = $request->input('days');
            $cutoffDate = now()->subDays($days);

            // Count before deletion
            $count = Activity::where('created_at', '<', $cutoffDate)->count();

            if ($count === 0) {
                return redirect()
                    ->route('admin.activity-logs.index')
                    ->with('info', 'Tidak ada activity log yang perlu dihapus.');
            }

            // Delete old logs
            $deleted = Activity::where('created_at', '<', $cutoffDate)->delete();

            // Log the cleanup action
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'deleted_count' => $deleted,
                    'days_threshold' => $days,
                    'cutoff_date' => $cutoffDate->toDateTimeString()
                ])
                ->log("Membersihkan {$deleted} activity log yang lebih dari {$days} hari");

            DB::commit();

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('success', "Berhasil menghapus {$deleted} activity log lama (lebih dari {$days} hari).");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error cleaning activity logs: ' . $e->getMessage());

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('error', 'Terjadi kesalahan saat membersihkan activity logs.');
        }
    }

    /**
     * Export activity logs to CSV.
     */
    public function export(Request $request)
    {
        try {
            $query = Activity::with(['causer', 'subject'])
                ->latest();

            // Apply same filters as index
            if ($request->filled('log_name')) {
                $query->where('log_name', $request->log_name);
            }

            if ($request->filled('event')) {
                $query->where('event', $request->event);
            }

            if ($request->filled('user_id')) {
                $query->where('causer_id', $request->user_id)
                    ->where('causer_type', 'App\Models\User');
            }

            if ($request->filled('subject_type')) {
                $query->where('subject_type', $request->subject_type);
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('description', 'like', '%' . $search . '%')
                        ->orWhereJsonContains('properties', $search);
                });
            }

            // Limit export to prevent memory issues
            $activities = $query->limit(10000)->get();

            // Generate CSV filename with timestamp
            $filename = 'activity-logs-' . now()->format('Y-m-d-His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ];

            $callback = function () use ($activities) {
                $file = fopen('php://output', 'w');

                // Add BOM for UTF-8 Excel compatibility
                fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

                // CSV Header
                fputcsv($file, [
                    'ID',
                    'Tanggal & Waktu',
                    'Deskripsi',
                    'Event',
                    'Log Name',
                    'User',
                    'Email User',
                    'Subject Type',
                    'Subject ID',
                    'Properties',
                    'Batch UUID'
                ]);

                // CSV Data
                foreach ($activities as $activity) {
                    fputcsv($file, [
                        $activity->id,
                        $activity->created_at->format('Y-m-d H:i:s'),
                        $activity->description,
                        $activity->event ?? '-',
                        $activity->log_name,
                        $activity->causer?->name ?? 'System',
                        $activity->causer?->email ?? '-',
                        $activity->subject_type ? class_basename($activity->subject_type) : '-',
                        $activity->subject_id ?? '-',
                        $activity->properties ? json_encode($activity->properties) : '-',
                        $activity->batch_uuid ?? '-'
                    ]);
                }

                fclose($file);
            };

            // Log export action
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'exported_count' => $activities->count(),
                    'filters' => $request->except(['_token'])
                ])
                ->log("Mengexport {$activities->count()} activity log ke CSV");

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            Log::error('Error exporting activity logs: ' . $e->getMessage());

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('error', 'Terjadi kesalahan saat mengexport activity logs.');
        }
    }

    /**
     * Get activity log statistics for dashboard or API.
     */
    public function statistics(Request $request)
    {
        try {
            // Basic statistics
            $stats = [
                'total' => Activity::count(),
                'today' => Activity::whereDate('created_at', today())->count(),
                'yesterday' => Activity::whereDate('created_at', today()->subDay())->count(),
                'this_week' => Activity::whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->count(),
                'last_week' => Activity::whereBetween('created_at', [
                    now()->subWeek()->startOfWeek(),
                    now()->subWeek()->endOfWeek()
                ])->count(),
                'this_month' => Activity::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'last_month' => Activity::whereMonth('created_at', now()->subMonth()->month)
                    ->whereYear('created_at', now()->subMonth()->year)
                    ->count(),
            ];

            // Activities by event type
            $stats['by_event'] = Activity::select('event', DB::raw('count(*) as total'))
                ->whereNotNull('event')
                ->groupBy('event')
                ->orderByDesc('total')
                ->get()
                ->map(function ($item) {
                    return [
                        'event' => ucfirst($item->event),
                        'total' => $item->total,
                        'percentage' => 0 // Will be calculated below
                    ];
                });

            // Calculate percentages
            $totalEvents = $stats['by_event']->sum('total');
            if ($totalEvents > 0) {
                $stats['by_event'] = $stats['by_event']->map(function ($item) use ($totalEvents) {
                    $item['percentage'] = round(($item['total'] / $totalEvents) * 100, 2);
                    return $item;
                });
            }

            // Activities by log name
            $stats['by_log_name'] = Activity::select('log_name', DB::raw('count(*) as total'))
                ->groupBy('log_name')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            // Top users by activity count
            $stats['top_users'] = Activity::select('causer_id', DB::raw('count(*) as total'))
                ->where('causer_type', 'App\Models\User')
                ->whereNotNull('causer_id')
                ->groupBy('causer_id')
                ->orderByDesc('total')
                ->limit(10)
                ->with('causer:id,name,email')
                ->get()
                ->map(function ($item) {
                    return [
                        'user_id' => $item->causer_id,
                        'user_name' => $item->causer?->name ?? 'Unknown',
                        'user_email' => $item->causer?->email ?? '-',
                        'activity_count' => $item->total
                    ];
                });

            // Recent activities
            $stats['recent_activities'] = Activity::with('causer:id,name')
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'description' => $activity->description,
                        'user' => $activity->causer?->name ?? 'System',
                        'created_at' => $activity->created_at->diffForHumans(),
                        'event' => $activity->event
                    ];
                });

            // Activity trend (last 7 days)
            $stats['daily_trend'] = collect(range(6, 0))->map(function ($daysAgo) {
                $date = now()->subDays($daysAgo);
                return [
                    'date' => $date->format('Y-m-d'),
                    'day' => $date->format('D'),
                    'count' => Activity::whereDate('created_at', $date)->count()
                ];
            });

            // Growth metrics
            $stats['growth'] = [
                'daily' => $this->calculateGrowth($stats['today'], $stats['yesterday']),
                'weekly' => $this->calculateGrowth($stats['this_week'], $stats['last_week']),
                'monthly' => $this->calculateGrowth($stats['this_month'], $stats['last_month']),
            ];

            // Database size estimate
            $stats['database_size'] = [
                'total_rows' => $stats['total'],
                'estimated_size_mb' => round(($stats['total'] * 2) / 1024, 2), // Rough estimate
            ];

            // Return as JSON if requested via API
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => true,
                    'data' => $stats
                ]);
            }

            // Return as view data
            return view('admin.activity-logs.statistics', compact('stats'));
        } catch (\Exception $e) {
            Log::error('Error getting activity log statistics: ' . $e->getMessage());

            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengambil statistik.'
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan saat mengambil statistik.');
        }
    }

    /**
     * Delete specific activity log.
     */
    public function destroy(Activity $activity)
    {
        try {
            DB::beginTransaction();

            $activityId = $activity->id;
            $description = $activity->description;

            // Delete the activity
            $activity->delete();

            // Log the deletion
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'deleted_activity_id' => $activityId,
                    'deleted_description' => $description
                ])
                ->log("Menghapus activity log #{$activityId}");

            DB::commit();

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('success', 'Activity log berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting activity log: ' . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan saat menghapus activity log.');
        }
    }

    /**
     * Bulk delete activity logs.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:activity_log,id'
        ]);

        try {
            DB::beginTransaction();

            $ids = $request->input('ids');
            $count = Activity::whereIn('id', $ids)->count();

            // Delete activities
            Activity::whereIn('id', $ids)->delete();

            // Log bulk deletion
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'deleted_count' => $count,
                    'deleted_ids' => $ids
                ])
                ->log("Menghapus {$count} activity log secara bulk");

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Berhasil menghapus {$count} activity log."
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error bulk deleting activity logs: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus activity logs.'
            ], 500);
        }
    }

    /**
     * Calculate growth percentage.
     */
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        $growth = (($current - $previous) / $previous) * 100;
        return round($growth, 2);
    }

    /**
     * Archive old logs (move to separate table or file).
     */
    public function archive(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:30|max:3650'
        ]);

        try {
            DB::beginTransaction();

            $days = $request->input('days');
            $cutoffDate = now()->subDays($days);

            // Get logs to archive
            $logsToArchive = Activity::where('created_at', '<', $cutoffDate)->get();

            if ($logsToArchive->isEmpty()) {
                return redirect()
                    ->route('admin.activity-logs.index')
                    ->with('info', 'Tidak ada activity log yang perlu diarsipkan.');
            }

            // Create archive file
            $filename = 'activity-logs-archive-' . now()->format('Y-m-d') . '.json';
            $archivePath = storage_path('app/archives/' . $filename);

            // Ensure directory exists
            if (!file_exists(dirname($archivePath))) {
                mkdir(dirname($archivePath), 0755, true);
            }

            // Save to file
            file_put_contents($archivePath, json_encode($logsToArchive->toArray(), JSON_PRETTY_PRINT));

            // Delete archived logs
            $deleted = Activity::where('created_at', '<', $cutoffDate)->delete();

            // Log archival
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'archived_count' => $deleted,
                    'archive_file' => $filename,
                    'days_threshold' => $days
                ])
                ->log("Mengarsipkan {$deleted} activity log ke {$filename}");

            DB::commit();

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('success', "Berhasil mengarsipkan {$deleted} activity log ke {$filename}.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error archiving activity logs: ' . $e->getMessage());

            return redirect()
                ->route('admin.activity-logs.index')
                ->with('error', 'Terjadi kesalahan saat mengarsipkan activity logs.');
        }
    }
}
