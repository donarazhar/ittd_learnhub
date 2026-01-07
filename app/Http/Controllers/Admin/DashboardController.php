<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalUsers = User::where('role', 'user')->count();
        $activeCourses = Course::where('status', 'published')->count();
        $totalEnrollments = Enrollment::count();

        // Popular courses
        $popularCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();

        // Recent enrollments
        $recentEnrollments = Enrollment::with(['user', 'course'])
            ->orderBy('enrolled_at', 'desc')
            ->take(10)
            ->get();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')]
        ];

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalUsers',
            'activeCourses',
            'totalEnrollments',
            'popularCourses',
            'recentEnrollments',
            'breadcrumbs'
        ));
    }
}
