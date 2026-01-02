<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Kursus -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-primary-100 rounded-md">
                            <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Kursus
                            </dt>
                            <dd class="text-2xl font-semibold text-gray-900">
                                {{ $totalCourses }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pegawai -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-green-100 rounded-md">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Pegawai
                            </dt>
                            <dd class="text-2xl font-semibold text-gray-900">
                                {{ $totalUsers }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kursus Aktif -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-secondary-100 rounded-md">
                            <svg class="h-6 w-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Kursus Aktif
                            </dt>
                            <dd class="text-2xl font-semibold text-gray-900">
                                {{ $activeCourses }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Enrollment -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-purple-100 rounded-md">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Total Enrollment
                            </dt>
                            <dd class="text-2xl font-semibold text-gray-900">
                                {{ $totalEnrollments }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Enrollments -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Enrollment Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentEnrollments as $enrollment)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center">
                                    <span class="text-white font-semibold">
                                        {{ substr($enrollment->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $enrollment->course->title }}</p>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500">{{ $enrollment->enrolled_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada enrollment.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Popular Courses -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Kursus Populer</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($popularCourses as $course)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $course->title }}</p>
                                <p class="text-sm text-gray-500">{{ $course->enrollments_count }} pegawai terdaftar</p>
                            </div>
                            <a href="{{ route('admin.courses.edit', $course) }}" 
                               class="text-primary-600 hover:text-primary-800">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada kursus.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection