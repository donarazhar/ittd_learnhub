<!-- resources/views/admin/analytics/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Analitik')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Analitik & Laporan</h1>
        <p class="mt-1 text-sm text-gray-600">Statistik dan aktivitas pembelajaran</p>
    </div>

    <!-- Completion Rate -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tingkat Penyelesaian Kursus</h3>
        <div class="flex items-center">
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Completion Rate</span>
                    <span class="text-2xl font-bold text-primary-600">{{ number_format($completionRate, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-gradient-primary h-4 rounded-full transition-all duration-300" 
                         style="width: {{ $completionRate }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Popular Courses -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Kursus Terpopuler</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($popularCourses as $course)
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $course->title }}</p>
                                <p class="text-sm text-gray-500">{{ $course->enrollments_count }} enrollment</p>
                            </div>
                            <div class="ml-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    {{ $course->enrollments_count }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data.</p>
                    @endforelse
                </div>
            </div>
        </div>

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
                                <div class="h-8 w-8 rounded-full bg-gradient-primary flex items-center justify-center">
                                    <span class="text-white text-xs font-semibold">
                                        {{ substr($enrollment->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($enrollment->course->title, 30) }}</p>
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
    </div>
@endsection