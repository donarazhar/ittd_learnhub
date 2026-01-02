<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $popularCourses = Course::published()
            ->orderBy('total_enrolled', 'desc')
            ->take(6)
            ->get();

        return view('home', compact('featuredCourses', 'popularCourses'));
    }
}
