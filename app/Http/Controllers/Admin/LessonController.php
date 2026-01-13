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

        // Preserve current tab and selected module - stay on lesson tab
        return redirect()->route('admin.courses.edit', $module->course)
            ->with('success', 'Materi berhasil ditambahkan!')
            ->with('current_step', 3)
            ->with('selected_module', $module->id);
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

        $module = $lesson->module;
        $course = $module->course;
        $lesson->delete();

        // Preserve current tab and selected module - stay on lesson tab
        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Materi berhasil dihapus!')
            ->with('current_step', 3)
            ->with('selected_module', $module->id);
    }

    public function reorder(Request $request, Module $module)
    {
        // Check authorization
        if (!auth()->user()->canManageCourse($module->course)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'lessons' => 'required|array',
            'lessons.*.id' => 'required|exists:lessons,id',
            'lessons.*.order' => 'required|integer',
        ]);

        try {
            foreach ($request->lessons as $lessonData) {
                $lesson = Lesson::find($lessonData['id']);

                // Verify lesson belongs to this module
                if ($lesson && $lesson->module_id == $module->id) {
                    $lesson->order = $lessonData['order'];
                    $lesson->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
