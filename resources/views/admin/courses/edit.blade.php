{{-- resources/views/admin/courses/edit.blade.php --}}

@extends('layouts.admin')

@section('title', 'Edit Kursus')

@section('content')
    <div x-data="courseEditor()">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.courses.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Kursus
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Edit Kursus: {{ $course->title }}</h1>
            </div>
            <div class="flex items-center space-x-3">
                @if ($course->status === 'draft')
                    <form method="POST" action="{{ route('admin.courses.publish', $course) }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Publish Kursus
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.courses.unpublish', $course) }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            Unpublish
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Course Info -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data"
                class="space-y-4" id="courseEditForm">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kursus</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                        <select name="level" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="beginner" {{ $course->level === 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ $course->level === 'intermediate' ? 'selected' : '' }}>
                                Intermediate</option>
                            <option value="advanced" {{ $course->level === 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="course_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="course_description"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description', $course->description) }}</textarea>
                    <p id="course-description-error" class="mt-1 text-sm text-red-600 hidden">Deskripsi wajib diisi.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                    @if ($course->thumbnail)
                        <div class="mb-2">
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="Current thumbnail"
                                class="h-20 w-auto rounded border">
                            <p class="text-xs text-gray-500 mt-1">Thumbnail saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="mt-1 text-sm text-gray-500">Upload gambar baru untuk mengganti thumbnail</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Modules & Lessons -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Modul & Materi</h2>
                <button @click="showAddModuleForm = true"
                    class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                    + Tambah Modul
                </button>
            </div>

            <!-- Add Module Form -->
            <div x-show="showAddModuleForm" x-transition class="mb-6 p-4 bg-gray-50 rounded-lg" style="display: none;">
                <form method="POST" action="{{ route('admin.modules.store', $course) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Modul</label>
                        <input type="text" name="title" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label for="module_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" id="module_description" rows="2"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">Simpan</button>
                        <button type="button" @click="showAddModuleForm = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Modules List -->
            @if ($course->modules->count() > 0)
                <div class="space-y-4">
                    @foreach ($course->modules as $module)
                        {{-- Each module has its own scope with open and showAddLesson --}}
                        <div class="border border-gray-200 rounded-lg" x-data="{ open: false, showAddLesson: false }">
                            
                            {{-- Module Header --}}
                            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between cursor-pointer"
                                @click="open = !open">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $module->title }}</h3>
                                    @if ($module->description)
                                        <p class="text-sm text-gray-600 mt-1">{{ $module->description }}</p>
                                    @endif
                                    <span class="text-xs text-gray-500 mt-1 block">{{ $module->lessons->count() }}
                                        materi</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    {{-- IMPORTANT: @click.stop prevents triggering parent's @click --}}
                                    <button type="button" @click.stop="showAddLesson = true"
                                        class="px-3 py-1 text-sm bg-primary-600 text-white rounded hover:bg-primary-700">
                                        + Materi
                                    </button>
                                    <form method="POST" action="{{ route('admin.modules.destroy', $module) }}"
                                        class="inline" onsubmit="return confirm('Yakin hapus modul ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" @click.stop class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Add Lesson Form (OUTSIDE collapsed content for better UX!) --}}
                            <div x-show="showAddLesson" x-transition class="px-6 py-4 bg-blue-50 border-t border-gray-200"
                                style="display: none;">
                                <form method="POST" action="{{ route('admin.lessons.store', $module) }}"
                                    class="space-y-3">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                                        <input type="text" name="title" required
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Video URL
                                            (YouTube)
                                        </label>
                                        <input type="url" name="video_url"
                                            placeholder="https://youtube.com/watch?v=..."
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="submit"
                                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm">Simpan</button>
                                        <button type="button" @click="showAddLesson = false"
                                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Batal</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Lessons List (INSIDE collapsed content) --}}
                            <div x-show="open" x-transition class="border-t border-gray-200" style="display: none;">
                                @if ($module->lessons->count() > 0)
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($module->lessons as $lesson)
                                            <li class="px-6 py-3 hover:bg-gray-50 flex items-center justify-between">
                                                <div class="flex items-center">
                                                    @if ($lesson->video_url)
                                                        <svg class="w-5 h-5 text-primary-600 mr-3" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    @endif
                                                    <span class="text-gray-900">{{ $lesson->title }}</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('admin.lessons.edit', $lesson) }}"
                                                        class="text-primary-600 hover:text-primary-800 text-sm">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('admin.lessons.destroy', $lesson) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Yakin hapus materi ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="px-6 py-4 text-gray-500 text-sm text-center">Belum ada materi. Klik "+
                                        Materi" untuk menambahkan.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Belum ada modul. Klik "Tambah Modul" untuk membuat modul pertama.
                </p>
            @endif
        </div>
    </div>

    {{-- TinyMCE Component for Course Description --}}
    <x-admin.tinymce id="course_description" :height="300" />

    {{-- Scripts --}}
    @push('scripts')
    <script>
        // Course editor Alpine component
        function courseEditor() {
            return {
                showAddModuleForm: false
            }
        }

        // Form validation for course description (TinyMCE)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('courseEditForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Sync TinyMCE content to textarea
                    if (typeof tinymce !== 'undefined' && tinymce.get('course_description')) {
                        tinymce.triggerSave();
                        
                        // Get TinyMCE content
                        const content = tinymce.get('course_description').getContent();
                        
                        // Check if empty
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = content;
                        const textContent = tempDiv.textContent || tempDiv.innerText || '';
                        
                        if (!content || textContent.trim() === '') {
                            e.preventDefault();
                            
                            // Show error message
                            document.getElementById('course-description-error').classList.remove('hidden');
                            
                            // Scroll to error
                            document.getElementById('course_description').scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center' 
                            });
                            
                            // Focus TinyMCE
                            tinymce.get('course_description').focus();
                            
                            return false;
                        }
                        
                        // Hide error if validation passes
                        document.getElementById('course-description-error').classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @endpush
@endsection