<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $enrollments = auth()->user()->enrollments()
            ->with('course')
            ->latest('enrolled_at')
            ->get();

        $inProgressCourses = $enrollments->where('completed_at', null);
        $completedCourses = $enrollments->whereNotNull('completed_at');

        $recentActivity = auth()->user()->activities()
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('enrollments', 'inProgressCourses', 'completedCourses', 'recentActivity'));
    }

    public function myCourses()
    {
        $enrollments = auth()->user()->enrollments()
            ->with('course')
            ->latest('enrolled_at')
            ->paginate(12);

        return view('my-courses', compact('enrollments'));
    }
}
