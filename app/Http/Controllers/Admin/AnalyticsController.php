<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\UserActivity;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Popular Courses
        $popularCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(10)
            ->get();

        // User Activity (last 30 days)
        $userActivity = UserActivity::select('activity_type', DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('activity_type')
            ->get();

        // Recent Enrollments
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->orderBy('enrolled_at', 'desc')
            ->take(10)
            ->get();

        // Completion Rate
        $totalEnrollments = Enrollment::count();
        $completedEnrollments = Enrollment::whereNotNull('completed_at')->count();
        $completionRate = $totalEnrollments > 0
            ? ($completedEnrollments / $totalEnrollments) * 100
            : 0;

        return view('admin.analytics.index', compact(
            'popularCourses',
            'userActivity',
            'recentEnrollments',
            'completionRate'
        ));
    }

    public function courseDetail(Course $course)
    {
        $enrollmentStats = [
            'total' => $course->enrollments()->count(),
            'completed' => $course->enrollments()->whereNotNull('completed_at')->count(),
            'in_progress' => $course->enrollments()->whereNull('completed_at')->count(),
        ];

        $averageProgress = $course->enrollments()->avg('progress_percentage');

        return view('admin.analytics.course', compact('course', 'enrollmentStats', 'averageProgress'));
    }
}
