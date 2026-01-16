<!-- resources/views/admin/lessons/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Materi')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="mb-6">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0053C5] transition">
                Dashboard
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('admin.courses.index') }}" class="hover:text-[#0053C5] transition">
                Kursus
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('admin.courses.edit', $lesson->module->course) }}" class="hover:text-[#0053C5] transition">
                {{ $lesson->module->course->title }}
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">Edit Materi</span>
        </nav>

        <!-- Back Button & Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('admin.courses.edit', $lesson->module->course) }}"
                    class="inline-flex items-center text-sm text-gray-600 hover:text-[#0053C5] mb-3 transition group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Kursus
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Edit Materi</h1>
                <p class="mt-2 text-sm text-gray-600 flex items-center flex-wrap">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        {{ $lesson->module->course->title }}
                    </span>
                    <span class="mx-2 text-gray-400">•</span>
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        {{ $lesson->module->title }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
        <form method="POST" action="{{ route('admin.lessons.update', $lesson) }}" class="divide-y divide-gray-100">
            @csrf
            @method('PUT')

            <div class="p-6 md:p-8 space-y-6">
                <!-- Title Field -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Materi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition @error('title') border-red-500 @enderror"
                        placeholder="Masukkan judul materi">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Video URL Field -->
                <div>
                    <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                        Video URL (YouTube)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="url" name="video_url" id="video_url"
                            value="{{ old('video_url', $lesson->video_url) }}"
                            placeholder="https://www.youtube.com/watch?v=..."
                            class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition @error('video_url') border-red-500 @enderror">
                    </div>
                    <p class="mt-2 text-sm text-gray-500 flex items-start">
                        <svg class="w-4 h-4 mr-1 mt-0.5 text-[#0053C5] flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Masukkan URL video YouTube lengkap. Video akan ditampilkan dalam materi kursus.</span>
                    </p>
                    @error('video_url')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Content Field with Rich Text Editor -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Konten Materi
                    </label>
                    <div class="relative">
                        <textarea name="content" id="content"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition @error('content') border-red-500 @enderror">{{ old('content', $lesson->content) }}</textarea>
                    </div>
                    <div class="mt-3 p-4 bg-blue-50 border border-blue-100 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-[#0053C5] mr-2 mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-gray-700">
                                <p class="font-medium text-[#0053C5] mb-1">Tips Penggunaan Editor:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-1">
                                    <li>Gunakan toolbar untuk memformat teks (bold, italic, heading, dll)</li>
                                    <li>Tambahkan gambar, video, dan link untuk memperkaya konten</li>
                                    <li>Sisipkan kode atau syntax dengan fitur code block</li>
                                    <li>Preview konten sebelum menyimpan perubahan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 md:px-8 py-5 bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('admin.courses.edit', $lesson->module->course) }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-[#0053C5] hover:bg-[#003d91] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0053C5] transition-all transform hover:scale-105 group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- TinyMCE Component --}}
    <x-admin.tinymce id="content" :height="500" />

    {{-- Success/Error Messages Toast (Optional) --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 z-50 animate-slide-in">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 z-50 animate-slide-in">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
            <button @click="show = false" class="ml-4 hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
@endsection

{{-- Custom Styles --}}
@push('styles')
    <style>
        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
@endpush
