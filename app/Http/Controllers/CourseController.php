<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::published()->with('creator');

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->latest('published_at')->paginate(12);

        return view('courses.index', compact('courses'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->with(['modules.lessons', 'creator', 'reviews.user'])
            ->firstOrFail();

        $userEnrollment = null;
        if (auth()->check()) {
            $userEnrollment = auth()->user()->enrollments()
                ->where('course_id', $course->id)
                ->first();
        }

        return view('courses.show', compact('course', 'userEnrollment'));
    }

    public function enroll(Course $course)
    {
        if (!$course->isPublished()) {
            return redirect()->back()
                ->with('error', 'Kursus ini belum dipublikasikan.');
        }

        if (auth()->user()->hasEnrolled($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('info', 'Anda sudah terdaftar di kursus ini.');
        }

        auth()->user()->enrollments()->create([
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        $course->incrementEnrollment();

        // Log activity
        auth()->user()->activities()->create([
            'activity_type' => 'course_enrolled',
            'activity_data' => json_encode(['course_id' => $course->id]),
        ]);

        return redirect()->route('courses.show', $course->slug)
            ->with('success', 'Berhasil mendaftar kursus!');
    }

    public function review(Request $request, Course $course)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        auth()->user()->reviews()->updateOrCreate(
            ['course_id' => $course->id],
            $validated
        );

        $course->updateAverageRating();

        return redirect()->back()
            ->with('success', 'Review berhasil disimpan!');
    }
}
