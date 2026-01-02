<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function store(Request $request, Module $module)
    {
        if (!auth()->user()->canManageCourse($module->course)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_duration' => 'nullable|integer',
        ]);

        $validated['module_id'] = $module->id;
        $validated['slug'] = Str::slug($validated['title']);
        $validated['order'] = $module->lessons()->max('order') + 1;

        Lesson::create($validated);

        return redirect()->back()
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function edit(Lesson $lesson)
    {
        if (!auth()->user()->canManageCourse($lesson->module->course)) {
            abort(403);
        }

        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        if (!auth()->user()->canManageCourse($lesson->module->course)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_duration' => 'nullable|integer',
        ]);

        $lesson->update($validated);

        return redirect()->route('admin.courses.edit', $lesson->module->course)
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Lesson $lesson)
    {
        if (!auth()->user()->canManageCourse($lesson->module->course)) {
            abort(403);
        }

        $lesson->delete();

        return redirect()->back()
            ->with('success', 'Materi berhasil dihapus!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|exists:lessons,id',
            'lessons.*.order' => 'required|integer',
        ]);

        foreach ($request->lessons as $lessonData) {
            Lesson::where('id', $lessonData['id'])
                ->update(['order' => $lessonData['order']]);
        }

        return response()->json(['success' => true]);
    }
}
