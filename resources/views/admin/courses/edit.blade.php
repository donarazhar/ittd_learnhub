<!-- resources/views/admin/courses/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Kursus')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Edit Kursus</h1>
        <p class="mt-1 text-sm text-gray-600">{{ $course->title }}</p>
    </div>
    <div class="flex items-center space-x-3">
        @if($course->status === 'draft')
        <form method="POST" action="{{ route('admin.courses.publish', $course) }}">
            @csrf
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Publish Kursus
            </button>
        </form>
        @elseif($course->status === 'published')
        <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 font-semibold rounded-lg">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            Published
        </span>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Course Info (Left) -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kursus</h3>

            <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $course->title) }}"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea
                        name="description"
                        rows="4"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">{{ old('description', $course->description) }}</textarea>
                </div>

                <!-- Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select
                        name="level"
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                        <option value="beginner" {{ $course->level === 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ $course->level === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="advanced" {{ $course->level === 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>

                <!-- Thumbnail -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail</label>
                    @if($course->thumbnail)
                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-32 object-cover rounded-lg mb-2">
                    @endif
                    <input
                        type="file"
                        name="thumbnail"
                        accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                </div>

                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-lg hover:bg-primary-700 transition text-sm font-medium">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    <!-- Modules & Lessons (Right) -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900">Modul & Materi</h3>
                <button
                    @click="$dispatch('open-modal', 'add-module')"
                    class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Modul
                </button>
            </div>

            <!-- Modules List -->
            <div class="space-y-4">
                @forelse($course->modules as $module)
                <div class="border border-gray-200 rounded-lg" x-data="{ open: false }">
                    <!-- Module Header -->
                    <div class="p-4 bg-gray-50 flex items-center justify-between cursor-pointer" @click="open = !open">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open ? 'rotate-90' : ''" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <h4 class="font-medium text-gray-900">{{ $module->title }}</h4>
                            <span class="text-sm text-gray-500">({{ $module->lessons->count() }} materi)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                type="button"
                                @click.stop="$dispatch('open-modal', 'add-lesson-{{ $module->id }}')"
                                class="text-sm text-primary-600 hover:text-primary-800">
                                + Tambah Materi
                            </button>
                            <form method="POST" action="{{ route('admin.modules.destroy', $module) }}"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800" @click.stop>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Lessons List -->
                    <div x-show="open" x-transition class="p-4 space-y-2" style="display: none;">
                        @forelse($module->lessons as $lesson)
                        <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-3">
                                @if($lesson->video_url)
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @else
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                @endif
                                <span class="text-sm text-gray-700">{{ $lesson->title }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.lessons.edit', $lesson) }}"
                                    class="text-sm text-primary-600 hover:text-primary-800">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-2">Belum ada materi.</p>
                        @endforelse
                    </div>

                    <!-- Add Lesson Modal -->
                    <div
                        x-data="{ show: false }"
                        @open-modal.window="if ($event.detail === 'add-lesson-{{ $module->id }}') show = true"
                        @close-modal.window="show = false"
                        @keydown.escape.window="show = false"
                        x-show="show"
                        class="fixed inset-0 z-50 overflow-y-auto"
                        style="display: none;">
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="show = false"></div>

                            <div class="relative bg-white rounded-lg max-w-lg w-full p-6" @click.stop>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Materi Baru</h3>

                                <form method="POST" action="{{ route('admin.lessons.store', $module) }}">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                                            <input type="text" name="title" required
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (YouTube) - Opsional</label>
                                            <input type="url" name="video_url" placeholder="https://www.youtube.com/watch?v=..."
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                                        </div>

                                        <div class="flex justify-end space-x-3 pt-4">
                                            <button type="button" @click="show = false"
                                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm font-medium">
                                                Tambah Materi
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 text-center py-8">Belum ada modul. Tambahkan modul pertama untuk memulai.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Module Modal -->
<div
    x-data="{ show: false }"
    @open-modal.window="if ($event.detail === 'add-module') show = true"
    @close-modal.window="show = false"
    @keydown.escape.window="show = false"
    x-show="show"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="show = false"></div>

        <div class="relative bg-white rounded-lg max-w-lg w-full p-6" @click.stop>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Modul Baru</h3>

            <form method="POST" action="{{ route('admin.modules.store', $course) }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Modul</label>
                        <input type="text" name="title" required
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" @click="show = false"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm font-medium">
                            Tambah Modul
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection