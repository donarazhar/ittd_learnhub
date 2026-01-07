<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserNote;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        // Check if user is enrolled
        if (!auth()->user()->hasEnrolled($course)) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus mendaftar terlebih dahulu untuk mengakses materi ini.');
        }

        // Load relationships
        $course->load([
            'modules.lessons' => function ($query) {
                $query->orderBy('order');
            }
        ]);

        // Get enrollment
        $enrollment = auth()->user()->enrollments()
            ->where('course_id', $course->id)
            ->first();

        // Update last accessed lesson
        $enrollment->update([
            'last_accessed_lesson_id' => $lesson->id
        ]);

        // Get user progress for current lesson
        $userProgress = $lesson->userProgress()
            ->where('user_id', auth()->id())
            ->first();

        // Get user notes for current lesson
        $notes = UserNote::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get discussions for current lesson
        $discussions = \App\Models\Discussion::with(['user', 'replies'])
            ->where('lesson_id', $lesson->id)
            ->latest()
            ->limit(5) // Show last 5 discussions in sidebar
            ->get();

        return view('learn.show', [
            'course' => $course,
            'currentLesson' => $lesson,
            'enrollment' => $enrollment,
            'userProgress' => $userProgress,
            'notes' => $notes,
            'discussions' => $discussions // ADD THIS
        ]);
    }

    public function updateProgress(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'is_completed' => 'required|boolean',
            'last_position' => 'nullable|integer'
        ]);

        $lesson = Lesson::findOrFail($request->lesson_id);
        $course = $lesson->module->course;

        // Check enrollment
        if (!auth()->user()->hasEnrolled($course)) {
            return response()->json(['success' => false, 'message' => 'Not enrolled'], 403);
        }

        // Update or create progress
        $progress = $lesson->userProgress()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'is_completed' => $request->is_completed,
                'last_position' => $request->last_position ?? 0,
                'completed_at' => $request->is_completed ? now() : null
            ]
        );

        // Recalculate course progress percentage
        $enrollment = auth()->user()->enrollments()
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            $totalLessons = $course->lessons()->count();
            $completedLessons = \App\Models\UserProgress::where('user_id', auth()->id())
                ->where('is_completed', true)
                ->whereHas('lesson.module', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })
                ->count();

            $progressPercentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;

            $enrollment->update([
                'progress_percentage' => $progressPercentage,
                'completed_at' => $progressPercentage >= 100 ? now() : null
            ]);

            // Log activity if completed
            if ($request->is_completed) {
                \App\Models\UserActivity::create([
                    'user_id' => auth()->id(),
                    'type' => 'lesson_completed',
                    'data' => [
                        'lesson_id' => $lesson->id,
                        'lesson_title' => $lesson->title,
                        'course_id' => $course->id,
                        'course_title' => $course->title
                    ]
                ]);
            }
        }

        return response()->json(['success' => true, 'progress' => $progress]);
    }

    public function saveNote(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'note' => 'required|string'
        ]);

        $lesson = Lesson::findOrFail($request->lesson_id);
        $course = $lesson->module->course;

        // Check enrollment
        if (!auth()->user()->hasEnrolled($course)) {
            return response()->json(['success' => false, 'message' => 'Not enrolled'], 403);
        }

        $note = UserNote::create([
            'user_id' => auth()->id(),
            'lesson_id' => $request->lesson_id,
            'note' => $request->note
        ]);

        return response()->json(['success' => true, 'note' => $note]);
    }
}