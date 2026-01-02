<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\UserProgress;
use App\Models\UserNote;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function show($courseSlug, $lessonSlug)
    {
        $course = Course::where('slug', $courseSlug)
            ->with(['modules.lessons'])
            ->firstOrFail();

        // Check if user enrolled
        if (!auth()->user()->hasEnrolled($course)) {
            return redirect()->route('courses.show', $courseSlug)
                ->with('error', 'Anda harus mendaftar terlebih dahulu.');
        }

        $currentLesson = Lesson::where('slug', $lessonSlug)
            ->with(['module', 'references', 'attachments'])
            ->firstOrFail();

        // Update last accessed lesson
        auth()->user()->enrollments()
            ->where('course_id', $course->id)
            ->update(['last_accessed_lesson_id' => $currentLesson->id]);

        // Get user progress
        $userProgress = $currentLesson->getProgressFor(auth()->user());

        // Get user notes
        $notes = auth()->user()->notes()
            ->where('lesson_id', $currentLesson->id)
            ->latest()
            ->get();

        // Calculate progress percentage
        $enrollment = auth()->user()->enrollments()
            ->where('course_id', $course->id)
            ->first();
        $progressPercentage = $enrollment->progress_percentage ?? 0;

        // Get discussions
        $discussions = $currentLesson->discussions()
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();

        return view('learn.show', compact(
            'course',
            'currentLesson',
            'userProgress',
            'notes',
            'progressPercentage',
            'discussions'
        ));
    }

    public function updateProgress(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'is_completed' => 'boolean',
            'last_position' => 'nullable|integer',
        ]);

        $progress = UserProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $validated['lesson_id'],
            ],
            [
                'is_completed' => $validated['is_completed'] ?? false,
                'completed_at' => ($validated['is_completed'] ?? false) ? now() : null,
                'last_position' => $validated['last_position'] ?? 0,
            ]
        );

        // Update enrollment progress
        $lesson = Lesson::find($validated['lesson_id']);
        $course = $lesson->module->course;

        $totalLessons = $course->lessons()->count();
        $completedLessons = UserProgress::where('user_id', auth()->id())
            ->whereIn('lesson_id', $course->lessons()->pluck('id'))
            ->where('is_completed', true)
            ->count();

        $percentage = ($completedLessons / $totalLessons) * 100;

        $enrollment = auth()->user()->enrollments()
            ->where('course_id', $course->id)
            ->first();

        $enrollment->update([
            'progress_percentage' => $percentage,
            'completed_at' => $percentage == 100 ? now() : null,
        ]);

        // Log activity
        if ($validated['is_completed'] ?? false) {
            auth()->user()->activities()->create([
                'activity_type' => 'lesson_completed',
                'activity_data' => json_encode(['lesson_id' => $validated['lesson_id']]),
            ]);
        }

        return response()->json(['success' => true, 'progress' => $percentage]);
    }

    public function saveNote(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'note' => 'required|string|max:2000',
        ]);

        $note = UserNote::create([
            'user_id' => auth()->id(),
            'lesson_id' => $validated['lesson_id'],
            'note' => $validated['note'],
        ]);

        return response()->json(['success' => true, 'note' => $note]);
    }
}