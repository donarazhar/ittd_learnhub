{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
    <div class="bg-white py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-dark-700">Dashboard Saya</h1>
            <p class="mt-2 text-dark-400">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm mb-1">Total Kursus</p>
                        <p class="text-3xl font-bold">{{ $enrollments->count() }}</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-secondary-500 to-secondary-700 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-secondary-100 text-sm mb-1">Sedang Belajar</p>
                        <p class="text-3xl font-bold">{{ $inProgressCourses->count() }}</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm mb-1">Selesai</p>
                        <p class="text-3xl font-bold">{{ $completedCourses->count() }}</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kursus Sedang Dipelajari -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-dark-700">Kursus Sedang Dipelajari</h2>
                    </div>
                    <div class="p-6">
                        @if ($inProgressCourses->count() > 0)
                            <div class="space-y-4">
                                @foreach ($inProgressCourses->take(5) as $enrollment)
                                    <div
                                        class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition">
                                        @if ($enrollment->course->thumbnail)
                                            <img src="{{ Storage::url($enrollment->course->thumbnail) }}"
                                                alt="{{ $enrollment->course->title }}"
                                                class="w-20 h-20 rounded object-cover">
                                        @else
                                            <div
                                                class="w-20 h-20 rounded bg-gradient-primary-soft flex items-center justify-center flex-shrink-0">
                                                <svg class="w-10 h-10 text-primary-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="ml-4 flex-1">
                                            <h3 class="font-semibold text-dark-700 mb-1">{{ $enrollment->course->title }}
                                            </h3>
                                            <div class="flex items-center text-sm text-dark-400 mb-2">
                                                <span>Progress:
                                                    {{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-gradient-primary h-2 rounded-full"
                                                    style="width: {{ $enrollment->progress_percentage }}%"></div>
                                            </div>
                                        </div>
                                        <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                            class="ml-4 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition text-sm font-medium">
                                            Lanjutkan
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @if ($inProgressCourses->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('my-courses') }}"
                                        class="text-primary-500 hover:text-primary-600 font-medium">
                                        Lihat Semua →
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h3 class="text-lg font-medium text-dark-700 mb-2">Belum ada kursus yang sedang dipelajari
                                </h3>
                                <p class="text-dark-400 mb-4">Mulai belajar dengan mendaftar kursus</p>
                                <a href="{{ route('courses.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                                    Jelajahi Kursus
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Completed Courses -->
                @if ($completedCourses->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm mt-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-dark-700">Kursus yang Telah Selesai</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($completedCourses->take(4) as $enrollment)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                        <div class="flex items-center justify-between mb-2">
                                            <span
                                                class="px-2 py-1 bg-secondary-100 text-secondary-800 text-xs font-semibold rounded-full">Selesai</span>
                                            <span
                                                class="text-xs text-dark-400">{{ $enrollment->completed_at->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="font-semibold text-dark-700 mb-2">{{ $enrollment->course->title }}</h3>
                                        <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                            class="text-primary-500 hover:text-primary-600 text-sm font-medium">
                                            Lihat Kursus →
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Activity Feed -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-dark-700">Aktivitas Terbaru</h2>
                    </div>
                    <div class="p-6">
                        @if ($recentActivity->count() > 0)
                            <div class="space-y-4">
                                @foreach ($recentActivity as $activity)
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            @if ($activity->activity_type === 'course_enrolled')
                                                <div class="p-2 bg-primary-100 rounded-lg">
                                                    <svg class="w-5 h-5 text-primary-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </div>
                                            @elseif($activity->activity_type === 'lesson_completed')
                                                <div class="p-2 bg-secondary-100 rounded-lg">
                                                    <svg class="w-5 h-5 text-secondary-700" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm text-dark-700">
                                                @if ($activity->activity_type === 'course_enrolled')
                                                    Mendaftar kursus baru
                                                @elseif($activity->activity_type === 'lesson_completed')
                                                    Menyelesaikan materi
                                                @endif
                                            </p>
                                            <p class="text-xs text-dark-400 mt-1">
                                                {{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-dark-400 text-center text-sm py-8">Belum ada aktivitas</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-lg shadow-sm p-6 mt-6 text-white">
                    <h3 class="font-bold text-lg mb-4">Mulai Belajar</h3>
                    <p class="text-primary-100 text-sm mb-6">Jelajahi kursus-kursus baru dan tingkatkan skill IT Anda</p>
                    <a href="{{ route('courses.index') }}"
                        class="block w-full text-center px-4 py-2 bg-white text-primary-500 font-semibold rounded-lg hover:bg-primary-50 transition">
                        Lihat Kursus
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
