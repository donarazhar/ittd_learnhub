<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function store(Request $request, Course $course)
    {
        if (!auth()->user()->canManageCourse($course)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['course_id'] = $course->id;
        $validated['order'] = $course->modules()->max('order') + 1;

        Module::create($validated);

        // Preserve current tab - stay on module tab
        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Modul berhasil ditambahkan!')
            ->with('current_step', 2);
    }

    public function update(Request $request, Module $module)
    {
        if (!auth()->user()->canManageCourse($module->course)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module->update($validated);

        // Preserve current tab - stay on module tab
        return redirect()->route('admin.courses.edit', $module->course)
            ->with('success', 'Modul berhasil diperbarui!')
            ->with('current_step', 2);
    }

    public function destroy(Module $module)
    {
        if (!auth()->user()->canManageCourse($module->course)) {
            abort(403);
        }

        $course = $module->course;
        $module->delete();

        // Preserve current tab - stay on module tab
        return redirect()->route('admin.courses.edit', $course)
            ->with('success', 'Modul berhasil dihapus!')
            ->with('current_step', 2);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'modules' => 'required|array',
            'modules.*.id' => 'required|exists:modules,id',
            'modules.*.order' => 'required|integer',
        ]);

        foreach ($request->modules as $moduleData) {
            Module::where('id', $moduleData['id'])
                ->update(['order' => $moduleData['order']]);
        }

        return response()->json(['success' => true]);
    }
}