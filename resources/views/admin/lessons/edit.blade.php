<!-- resources/views/admin/lessons/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Materi')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.courses.edit', $lesson->module->course) }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Kursus
            </a>
            <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Materi</h1>
            <p class="mt-1 text-sm text-gray-600">{{ $lesson->module->course->title }} > {{ $lesson->module->title }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Materi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <!-- Video URL -->
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Video URL (YouTube)
                    </label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $lesson->video_url) }}"
                        placeholder="https://www.youtube.com/watch?v=..."
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Masukkan URL video YouTube</p>
                </div>

                <!-- Content with TinyMCE -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Konten Materi
                    </label>
                    <textarea name="content" id="content"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('content', $lesson->content) }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Gunakan editor di atas untuk format teks, menambahkan gambar, video, kode, dan konten lainnya.
                    </p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                    <a href="{{ route('admin.courses.edit', $lesson->module->course) }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TinyMCE Component --}}
    <x-admin.tinymce id="content" :height="500" />
@endsection