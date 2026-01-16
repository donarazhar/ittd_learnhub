{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
    <!-- Hero Section - Modern & Clean -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-hero-pattern opacity-5"></div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                <!-- Welcome Message -->
                <div class="flex-1">
                    <div class="flex items-center gap-4 sm:gap-5">
                        <!-- Avatar -->
                        <div class="relative">
                            <div
                                class="h-16 w-16 sm:h-20 sm:w-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-2xl sm:text-3xl font-bold text-white shadow-lg border border-white/20">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-400 rounded-full border-2 border-primary-700 flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div>
                            <p class="text-primary-200 text-sm sm:text-base font-medium mb-1">Selamat datang kembali</p>
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight">
                                {{ auth()->user()->name }} 👋
                            </h1>
                            <p class="text-primary-100 text-sm sm:text-base mt-1 hidden sm:block">Mari lanjutkan perjalanan
                                pembelajaran Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Summary Card -->
                <div class="w-full lg:w-auto">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 sm:p-6 border border-white/20 shadow-xl">
                        <div class="grid grid-cols-3 gap-4 sm:gap-8">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-1">
                                    {{ $enrollments->count() }}</div>
                                <div class="text-xs sm:text-sm text-primary-100 font-medium">Total Kursus</div>
                            </div>
                            <div class="text-center border-l border-white/20 pl-4 sm:pl-8">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-1">
                                    {{ $completedCourses->count() }}</div>
                                <div class="text-xs sm:text-sm text-primary-100 font-medium">Selesai</div>
                            </div>
                            <div class="text-center border-l border-white/20 pl-4 sm:pl-8">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-1">
                                    {{ number_format($averageProgress ?? 0, 0) }}%</div>
                                <div class="text-xs sm:text-sm text-primary-100 font-medium">Progress</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-10 -mt-8 relative z-10">
            <!-- Total Courses -->
            <div class="card p-5 sm:p-6 group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="badge-primary text-xs">Total</span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-dark-800 mb-1">{{ $enrollments->count() }}</div>
                <p class="text-sm text-dark-400">Kursus Terdaftar</p>
            </div>

            <!-- In Progress -->
            <div class="card p-5 sm:p-6 group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="badge-warning text-xs">Aktif</span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-dark-800 mb-1">{{ $inProgressCourses->count() }}</div>
                <p class="text-sm text-dark-400">Sedang Belajar</p>
            </div>

            <!-- Completed -->
            <div class="card p-5 sm:p-6 group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="badge-success text-xs">Selesai</span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-dark-800 mb-1">{{ $completedCourses->count() }}</div>
                <p class="text-sm text-dark-400">Kursus Selesai</p>
            </div>

            <!-- Learning Time -->
            <div class="card p-5 sm:p-6 group">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-violet-100 text-violet-700">Waktu</span>
                </div>
                <div class="text-2xl sm:text-3xl font-bold text-dark-800 mb-1">{{ $totalLearningHours ?? 0 }}</div>
                <p class="text-sm text-dark-400">Jam Belajar</p>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Continue Learning Section -->
                <div class="card overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-50 to-white px-5 sm:px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg sm:text-xl font-bold text-dark-800 flex items-center">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                Lanjutkan Belajar
                            </h2>
                            @if ($inProgressCourses->count() > 3)
                                <a href="{{ route('my-courses') }}"
                                    class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center group">
                                    Lihat Semua
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 sm:p-6">
                        @if ($inProgressCourses->count() > 0)
                            <div class="space-y-4">
                                @foreach ($inProgressCourses->take(3) as $enrollment)
                                    <div
                                        class="group border border-gray-100 rounded-xl p-4 sm:p-5 hover:border-primary-200 hover:shadow-soft transition-all duration-300 bg-white">
                                        <div class="flex flex-col sm:flex-row items-start gap-4">
                                            <!-- Thumbnail -->
                                            <div class="flex-shrink-0 w-full sm:w-auto">
                                                @if ($enrollment->course->thumbnail)
                                                    <img src="{{ Storage::url($enrollment->course->thumbnail) }}"
                                                        alt="{{ $enrollment->course->title }}"
                                                        class="w-full sm:w-24 h-32 sm:h-24 rounded-xl object-cover shadow-sm group-hover:shadow-md transition">
                                                @else
                                                    <div
                                                        class="w-full sm:w-24 h-32 sm:h-24 rounded-xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-sm">
                                                        <svg class="w-10 h-10 text-white/70" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0 w-full">
                                                <h3
                                                    class="font-bold text-dark-800 text-base sm:text-lg mb-2 group-hover:text-primary-600 transition line-clamp-2">
                                                    {{ $enrollment->course->title }}
                                                </h3>

                                                <!-- Progress Info -->
                                                <div
                                                    class="flex flex-wrap items-center gap-3 sm:gap-4 mb-3 text-sm text-dark-400">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-primary-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span
                                                            class="font-semibold text-primary-600">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                                        <span class="ml-1">selesai</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-dark-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                        <span>{{ $enrollment->course->modules->sum(function ($module) {return $module->lessons->count();}) }}
                                                            materi</span>
                                                    </div>
                                                </div>

                                                <!-- Progress Bar -->
                                                <div class="mb-3">
                                                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-2 rounded-full transition-all duration-500"
                                                            style="width: {{ $enrollment->progress_percentage }}%"></div>
                                                    </div>
                                                </div>

                                                <!-- Last Activity & CTA -->
                                                <div
                                                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                                    <p class="text-xs text-dark-400 flex items-center">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Terakhir diakses
                                                        {{ optional($enrollment->updated_at)->diffForHumans() ?? 'baru saja' }}
                                                    </p>

                                                    <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                                        class="btn-primary py-2.5 px-5 text-sm w-full sm:w-auto justify-center group/btn">
                                                        <span>Lanjutkan</span>
                                                        <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12 sm:py-16">
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center">
                                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-dark-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-dark-800 mb-3">Belum Ada Kursus Aktif</h3>
                                <p class="text-dark-400 mb-6 max-w-md mx-auto">
                                    Mulai perjalanan pembelajaran Anda dengan memilih kursus yang sesuai dengan kebutuhan
                                </p>
                                <a href="{{ route('courses.index') }}" class="btn-primary">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Jelajahi Kursus
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Completed Courses -->
                @if ($completedCourses->count() > 0)
                    <div class="card overflow-hidden">
                        <div
                            class="bg-gradient-to-r from-emerald-50 to-white px-5 sm:px-6 py-4 border-b border-emerald-100">
                            <div class="flex items-center justify-between">
                                <h2 class="text-lg sm:text-xl font-bold text-dark-800 flex items-center">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Pencapaian Anda
                                </h2>
                                <span class="badge-success">
                                    🎉 {{ $completedCourses->count() }} Selesai
                                </span>
                            </div>
                        </div>

                        <div class="p-5 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($completedCourses->take(4) as $enrollment)
                                    <div
                                        class="group border border-gray-100 rounded-xl p-4 hover:border-emerald-200 hover:shadow-soft transition bg-gradient-to-br from-white to-emerald-50/30">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="badge-success text-xs">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Selesai
                                            </span>
                                            <span class="text-xs text-dark-400">
                                                {{ optional($enrollment->completed_at)->format('d M Y') ?? (optional($enrollment->updated_at)->format('d M Y') ?? '-') }}
                                            </span>
                                        </div>
                                        <h3
                                            class="font-bold text-dark-800 mb-3 line-clamp-2 group-hover:text-emerald-600 transition">
                                            {{ $enrollment->course->title }}
                                        </h3>
                                        <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                            class="inline-flex items-center text-emerald-600 hover:text-emerald-700 text-sm font-semibold group/link">
                                            Lihat Kursus
                                            <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            @if ($completedCourses->count() > 4)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('my-courses') }}"
                                        class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm inline-flex items-center group">
                                        Lihat Semua Pencapaian ({{ $completedCourses->count() }})
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Activity Feed -->
                <div class="card overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-5 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Aktivitas Terbaru
                        </h3>
                    </div>
                    <div class="p-5">
                        @if ($recentActivity->count() > 0)
                            <div class="space-y-4">
                                @foreach ($recentActivity as $activity)
                                    <div class="flex items-start group">
                                        <div class="flex-shrink-0">
                                            @if ($activity->activity_type === 'course_enrolled')
                                                <div
                                                    class="p-2.5 bg-primary-100 rounded-xl group-hover:bg-primary-200 transition">
                                                    <svg class="w-4 h-4 text-primary-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </div>
                                            @elseif($activity->activity_type === 'lesson_completed')
                                                <div
                                                    class="p-2.5 bg-emerald-100 rounded-xl group-hover:bg-emerald-200 transition">
                                                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-dark-700">
                                                @if ($activity->activity_type === 'course_enrolled')
                                                    Mendaftar kursus baru
                                                @elseif($activity->activity_type === 'lesson_completed')
                                                    Menyelesaikan materi
                                                @endif
                                            </p>
                                            <p class="text-xs text-dark-400 mt-1 flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ optional($activity->created_at)->diffForHumans() ?? 'Baru saja' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div
                                    class="w-16 h-16 mx-auto mb-3 bg-gray-100 rounded-2xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-dark-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="text-dark-400 text-sm">Belum ada aktivitas</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 p-6 text-white shadow-xl">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>

                    <div class="relative">
                        <div class="flex items-start mb-4">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Mulai Belajar</h3>
                                <p class="text-primary-100 text-sm">
                                    Jelajahi berbagai kursus IT dan tingkatkan skill Anda
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('courses.index') }}"
                            class="block w-full text-center px-5 py-3 bg-white text-primary-600 font-bold rounded-xl hover:bg-primary-50 transition shadow-lg hover:shadow-xl">
                            Lihat Semua Kursus
                        </a>
                    </div>
                </div>

                <!-- Learning Tips -->
                <div class="card p-5 bg-gradient-to-br from-amber-50 to-orange-50 border-amber-200">
                    <div class="flex items-start mb-4">
                        <div class="w-10 h-10 bg-amber-200 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-900 mb-3">Tips Belajar</h4>
                            <ul class="space-y-2 text-sm text-amber-800">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-amber-600" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Tetapkan jadwal belajar rutin
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-amber-600" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Praktikkan langsung materi
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-amber-600" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Diskusi dengan komunitas
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
