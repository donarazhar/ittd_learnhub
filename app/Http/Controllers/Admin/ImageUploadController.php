<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    /**
     * Handle image upload from TinyMCE
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Max 2MB
        ]);

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                // Store in public disk under 'tinymce' folder
                $path = $file->storeAs('tinymce', $filename, 'public');

                // Return URL for TinyMCE
                return response()->json([
                    'location' => Storage::url($path)
                ]);
            }

            return response()->json([
                'error' => 'No file uploaded'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
