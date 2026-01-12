<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display activity logs.
     */
    public function index(Request $request)
    {
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

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $activities = $query->paginate(50);

        // Get unique log names for filter
        $logNames = Activity::select('log_name')
            ->distinct()
            ->pluck('log_name');

        // Get unique events for filter
        $events = Activity::select('event')
            ->distinct()
            ->whereNotNull('event')
            ->pluck('event');

        return view('admin.activity-logs.index', compact('activities', 'logNames', 'events'));
    }

    /**
     * Show single activity log detail.
     */
    public function show(Activity $activity)
    {
        $activity->load(['causer', 'subject']);

        return view('admin.activity-logs.show', compact('activity'));
    }

    /**
     * Clean old activity logs.
     */
    public function clean(Request $request)
    {
        $days = $request->input('days', 365);

        $deleted = Activity::where('created_at', '<', now()->subDays($days))
            ->delete();

        activity()
            ->causedBy(auth()->user())
            ->log("Membersihkan {$deleted} activity log yang lebih dari {$days} hari");

        return redirect()
            ->route('admin.activity-logs.index')
            ->with('success', "Berhasil menghapus {$deleted} activity log lama.");
    }

    /**
     * Export activity logs.
     */
    public function export(Request $request)
    {
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

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->get();

        // Generate CSV
        $filename = 'activity-logs-' . now()->format('Y-m-d-His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($activities) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, [
                'ID',
                'Waktu',
                'Deskripsi',
                'Event',
                'Log Name',
                'User',
                'Subject Type',
                'Subject ID',
            ]);

            // Data
            foreach ($activities as $activity) {
                fputcsv($file, [
                    $activity->id,
                    $activity->created_at->format('Y-m-d H:i:s'),
                    $activity->description,
                    $activity->event ?? '-',
                    $activity->log_name,
                    $activity->causer?->name ?? 'System',
                    $activity->subject_type ? class_basename($activity->subject_type) : '-',
                    $activity->subject_id ?? '-',
                ]);
            }

            fclose($file);
        };

        activity()
            ->causedBy(auth()->user())
            ->log("Mengexport {$activities->count()} activity log");

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get statistics for dashboard.
     */
    public function statistics()
    {
        $stats = [
            'total' => Activity::count(),
            'today' => Activity::whereDate('created_at', today())->count(),
            'this_week' => Activity::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Activity::whereMonth('created_at', now()->month)->count(),
            'by_event' => Activity::select('event', \DB::raw('count(*) as total'))
                ->whereNotNull('event')
                ->groupBy('event')
                ->get(),
            'top_users' => Activity::select('causer_id', \DB::raw('count(*) as total'))
                ->where('causer_type', 'App\Models\User')
                ->groupBy('causer_id')
                ->orderByDesc('total')
                ->limit(10)
                ->with('causer')
                ->get(),
        ];

        return response()->json($stats);
    }
}