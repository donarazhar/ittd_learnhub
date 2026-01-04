<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-gradient-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-white mb-2">Dashboard</h1>
            <p class="text-blue-100">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-primary-100 rounded-lg">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Kursus</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $enrollments->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-secondary-100 rounded-lg">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Sedang Berjalan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $inProgressCourses->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $completedCourses->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Continue Learning -->
        @if ($inProgressCourses->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Lanjutkan Belajar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($inProgressCourses as $enrollment)
                        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                            @if ($enrollment->course->thumbnail)
                                <img src="{{ Storage::url($enrollment->course->thumbnail) }}"
                                    alt="{{ $enrollment->course->title }}" class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gradient-primary-soft flex items-center justify-center">
                                    <svg class="w-12 h-12 text-primary-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-5">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $enrollment->course->title }}</h3>
                                <div class="mb-3">
                                    <div class="flex items-center justify-between text-sm mb-1">
                                        <span class="text-gray-600">Progress</span>
                                        <span
                                            class="font-semibold text-primary-600">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full"
                                            style="width: {{ $enrollment->progress_percentage }}%"></div>
                                    </div>
                                </div>
                                <a href="{{ route('learn.show', [$enrollment->course->slug, $enrollment->lastAccessedLesson ? $enrollment->lastAccessedLesson->slug : $enrollment->course->modules->first()->lessons->first()->slug]) }}"
                                    class="block w-full text-center px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition text-sm">
                                    Lanjutkan
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- All Courses -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Semua Kursus Saya</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kursus
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Progress
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($enrollments as $enrollment)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $enrollment->course->title }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $enrollment->course->creator->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-32 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-primary-600 h-2 rounded-full"
                                                    style="width: {{ $enrollment->progress_percentage }}%"></div>
                                            </div>
                                            <span
                                                class="text-sm text-gray-600">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($enrollment->completed_at)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Selesai</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Berlangsung
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('learn.show', [$enrollment->course->slug, $enrollment->lastAccessedLesson ? $enrollment->lastAccessedLesson->slug : $enrollment->course->modules->first()->lessons->first()->slug]) }}"
                                            class="text-primary-600 hover:text-primary-900">
                                            {{ $enrollment->completed_at ? 'Lihat Kembali' : 'Lanjutkan' }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Anda belum mengikuti kursus apapun. <a href="{{ route('courses.index') }}"
                                            class="text-primary-600 hover:text-primary-900">Jelajahi kursus</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
