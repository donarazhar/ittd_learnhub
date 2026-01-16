<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-[#0053C5] to-[#003d91] rounded-xl shadow-lg p-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">
                        Selamat datang, {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-blue-100">
                        {{ now()->format('l, d F Y') }} • {{ now()->format('H:i') }} WIB
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg px-6 py-3">
                        <p class="text-sm text-blue-100">Role</p>
                        <p class="text-xl font-bold">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <!-- Total Kursus -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-[#0053C5] hover:shadow-xl transition">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-blue-100 rounded-xl shadow-md">
                            <svg class="h-8 w-8 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-600 truncate">
                                Total Kursus
                            </dt>
                            <dd class="text-3xl font-bold text-gray-900">
                                {{ $totalCourses }}
                            </dd>
                            <dd class="text-xs text-gray-500 mt-1">
                                {{ $activeCourses }} aktif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pegawai -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-green-500 hover:shadow-xl transition">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-green-100 rounded-xl shadow-md">
                            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-600 truncate">
                                Total Pegawai
                            </dt>
                            <dd class="text-3xl font-bold text-gray-900">
                                {{ $totalUsers }}
                            </dd>
                            <dd class="text-xs text-gray-500 mt-1">
                                User aktif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Enrollment -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-purple-500 hover:shadow-xl transition">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-purple-100 rounded-xl shadow-md">
                            <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-600 truncate">
                                Total Enrollment
                            </dt>
                            <dd class="text-3xl font-bold text-gray-900">
                                {{ $totalEnrollments }}
                            </dd>
                            <dd class="text-xs text-gray-500 mt-1">
                                Pendaftaran kursus
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-l-4 border-orange-500 hover:shadow-xl transition">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="p-3 bg-orange-100 rounded-xl shadow-md">
                            <svg class="h-8 w-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-600 truncate">
                                Completion Rate
                            </dt>
                            <dd class="text-3xl font-bold text-gray-900">
                                {{ number_format($completionRate ?? 0, 1) }}%
                            </dd>
                            <dd class="text-xs text-gray-500 mt-1">
                                Rata-rata penyelesaian
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Enrollment Trend Chart -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    Trend Enrollment (7 Hari Terakhir)
                </h3>
            </div>
            <div class="p-6">
                <canvas id="enrollmentChart" height="250"></canvas>
            </div>
        </div>

        <!-- Course by Level -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    Kursus Berdasarkan Level
                </h3>
            </div>
            <div class="p-6">
                <canvas id="levelChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Recent Enrollments -->
        <div class="lg:col-span-2 bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Enrollment Terbaru
                    </h3>
                    <a href="{{ route('admin.courses.index') }}"
                        class="text-sm text-[#0053C5] hover:text-[#003d91] font-semibold">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentEnrollments as $enrollment)
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center flex-1">
                                <div
                                    class="h-12 w-12 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center shadow-md">
                                    <span class="text-white font-bold text-lg">
                                        {{ substr($enrollment->user->name, 0, 1) }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-bold text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-xs text-gray-600 mt-1">{{ $enrollment->course->title }}</p>
                                    <div class="mt-2">
                                        <div class="flex items-center">
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-[#0053C5] h-2 rounded-full"
                                                    style="width: {{ $enrollment->progress_percentage ?? 0 }}%"></div>
                                            </div>
                                            <span
                                                class="ml-2 text-xs font-semibold text-gray-600">{{ number_format($enrollment->progress_percentage ?? 0, 0) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 text-right">
                                <span class="text-xs text-gray-500">{{ $enrollment->enrolled_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="text-sm text-gray-500">Belum ada enrollment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="space-y-6">
            <!-- Popular Courses -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Kursus Populer
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @forelse($popularCourses as $course)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $course->title }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="inline-flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                            </svg>
                                            {{ $course->enrollments_count }} pegawai
                                        </span>
                                    </p>
                                </div>
                                <a href="{{ route('admin.courses.edit', $course) }}"
                                    class="ml-3 text-[#0053C5] hover:text-[#003d91] transition">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-sm text-gray-500">Belum ada kursus.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Aktivitas Terbaru
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @if (isset($recentActivities))
                            @forelse($recentActivities as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#0053C5]" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-900">{{ $activity->description }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">Tidak ada aktivitas terbaru.</p>
                            @endforelse
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">Tidak ada aktivitas terbaru.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-gray-50 to-blue-50 shadow-lg rounded-xl border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Quick Actions
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.courses.create') }}"
                class="flex flex-col items-center justify-center p-4 bg-white rounded-lg hover:shadow-md transition group">
                <div
                    class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700">Buat Kursus</span>
            </a>

            <a href="{{ route('admin.users.create') }}"
                class="flex flex-col items-center justify-center p-4 bg-white rounded-lg hover:shadow-md transition group">
                <div
                    class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700">Tambah User</span>
            </a>

            <a href="{{ route('admin.activity-logs.index') }}"
                class="flex flex-col items-center justify-center p-4 bg-white rounded-lg hover:shadow-md transition group">
                <div
                    class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700">Activity Logs</span>
            </a>

            <a href="{{ route('admin.backups.index') }}"
                class="flex flex-col items-center justify-center p-4 bg-white rounded-lg hover:shadow-md transition group">
                <div
                    class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700">Backup</span>
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Enrollment Trend Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($enrollmentTrend['labels'] ?? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']) !!},
                datasets: [{
                    label: 'Enrollments',
                    data: {!! json_encode($enrollmentTrend['data'] ?? [12, 19, 15, 25, 22, 30, 28]) !!},
                    borderColor: '#0053C5',
                    backgroundColor: 'rgba(0, 83, 197, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#0053C5',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0053C5',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        borderRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Course by Level Chart
        const levelCtx = document.getElementById('levelChart').getContext('2d');
        new Chart(levelCtx, {
            type: 'doughnut',
            data: {
                labels: ['Beginner', 'Intermediate', 'Advanced'],
                datasets: [{
                    data: {!! json_encode($courseByLevel ?? [45, 35, 20]) !!},
                    backgroundColor: [
                        '#10B981',
                        '#0053C5',
                        '#8B5CF6'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12,
                                family: 'Inter, sans-serif'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0053C5',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        borderRadius: 8
                    }
                }
            }
        });
    </script>
@endpush
