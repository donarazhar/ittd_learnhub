
@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Analytics & Laporan</h1>
    <p class="mt-1 text-sm text-gray-600">Ringkasan performa platform pembelajaran</p>
</div>

<!-- Key Metrics -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Courses</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Course::count() }}</p>
            </div>
            <div class="p-3 bg-primary-100 rounded-lg">
                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Enrollments</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Enrollment::count() }}</p>
            </div>
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Completion Rate</p>
                <p class="text-3xl font-bold text-gray-900">{{ number_format($completionRate, 1) }}%</p>
            </div>
            <div class="p-3 bg-purple-100 rounded-lg">
                <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">Active Learners</p>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Enrollment::whereNull('completed_at')->distinct('user_id')->count() }}</p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-lg">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Popular Courses -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-900">Top 10 Popular Courses</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($popularCourses as $course)
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $course->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $course->enrollments_count }} enrollments</p>
                        </div>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-primary-600 hover:text-primary-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Enrollments -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-900">Recent Enrollments</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($recentEnrollments as $enrollment)
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center text-white font-semibold">
                            {{ substr($enrollment->user->name, 0, 1) }}
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $enrollment->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $enrollment->course->title }}</p>
                        </div>
                        <span class="text-xs text-gray-500">{{ $enrollment->enrolled_at->diffForHumans() }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="bg-white rounded-lg shadow lg:col-span-2">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-900">User Activity (Last 30 Days)</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($userActivity as $activity)
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-2xl font-bold text-primary-600">{{ $activity->count }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ str_replace('_', ' ', ucfirst($activity->activity_type)) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection