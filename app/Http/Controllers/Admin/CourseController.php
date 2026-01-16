<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('creator')
            ->when(auth()->user()->role === 'kontributor', function ($query) {
                $query->where('created_by', auth()->id());
            })
            ->latest()
            ->paginate(5);

        $breadcrumbs = [
            ['label' => 'Kursus', 'url' => route('admin.courses.index')]
        ];

        return view('admin.courses.index', compact('courses','breadcrumbs'));
    }

    public function create()
    {
        $breadcrumbs = [
            ['label' => 'Kursus', 'url' => route('admin.courses.index')],
            ['label' => 'Buat Kursus Baru', 'url' => route('admin.courses.create')]
        ];
        return view('admin.courses.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['status'] = 'draft';

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course = Course::create($validated);

        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Kursus berhasil dibuat! Silakan tambahkan modul dan materi.');
    }

    public function edit(Course $course)
    {
        // Cek permission
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        $course->load(['modules.lessons']);

        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Kursus berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        // Delete thumbnail
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus!');
    }

    public function publish(Course $course)
    {
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        $course->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        // TODO: Send notification to all users
        // Notification::send(User::where('role', 'user')->get(), new NewCoursePublished($course));

        return redirect()->back()
            ->with('success', 'Kursus berhasil dipublikasikan!');
    }

    public function unpublish(Course $course)
    {
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        $course->update([
            'status' => 'draft',
        ]);

        return redirect()->back()
            ->with('success', 'Kursus berhasil di-unpublish!');
    }
}
