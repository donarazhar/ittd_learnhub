{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center mb-4">
                        <div
                            class="h-16 w-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-2xl font-bold mr-4 shadow-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold mb-2">
                                Selamat Datang Kembali, {{ auth()->user()->name }}! 👋
                            </h1>
                            <p class="text-primary-100 text-lg">Mari lanjutkan perjalanan pembelajaran Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Summary -->
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-1">{{ $enrollments->count() }}</div>
                            <div class="text-sm text-white/80">Total Kursus</div>
                        </div>
                        <div class="text-center border-l border-white/20">
                            <div class="text-3xl font-bold mb-1">{{ $completedCourses->count() }}</div>
                            <div class="text-sm text-white/80">Selesai</div>
                        </div>
                        <div class="text-center border-l border-white/20">
                            <div class="text-3xl font-bold mb-1">{{ number_format($averageProgress ?? 0, 0) }}%</div>
                            <div class="text-sm text-white/80">Rata-rata</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Detailed Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Courses -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-md group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Total</span>
                    </div>
                    <div class="mb-2">
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $enrollments->count() }}</div>
                        <p class="text-sm text-gray-600">Kursus Terdaftar</p>
                    </div>
                    <div class="flex items-center text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Semua waktu
                    </div>
                </div>
            </div>

            <!-- In Progress -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-3 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg shadow-md group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Aktif</span>
                    </div>
                    <div class="mb-2">
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $inProgressCourses->count() }}</div>
                        <p class="text-sm text-gray-600">Sedang Belajar</p>
                    </div>
                    <div class="flex items-center text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Butuh perhatian
                    </div>
                </div>
            </div>

            <!-- Completed -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg shadow-md group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Selesai</span>
                    </div>
                    <div class="mb-2">
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $completedCourses->count() }}</div>
                        <p class="text-sm text-gray-600">Kursus Selesai</p>
                    </div>
                    <div class="flex items-center text-xs text-green-600 font-medium">
                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $completedCourses->count() > 0 ? 'Mantap!' : 'Mulai sekarang!' }}
                    </div>
                </div>
            </div>

            <!-- Learning Time -->
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-3 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg shadow-md group-hover:scale-110 transition">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Waktu</span>
                    </div>
                    <div class="mb-2">
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalLearningHours ?? 0 }}</div>
                        <p class="text-sm text-gray-600">Jam Belajar</p>
                    </div>
                    <div class="flex items-center text-xs text-gray-500">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Bulan ini
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Continue Learning Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Lanjutkan Belajar
                            </h2>
                            @if ($inProgressCourses->count() > 3)
                                <a href="{{ route('my-courses') }}"
                                    class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center">
                                    Lihat Semua
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($inProgressCourses->count() > 0)
                            <div class="space-y-4">
                                @foreach ($inProgressCourses->take(3) as $enrollment)
                                    <div
                                        class="group border border-gray-200 rounded-xl p-5 hover:border-primary-300 hover:shadow-md transition-all duration-300">
                                        <div class="flex items-start gap-5">
                                            <!-- Thumbnail -->
                                            <div class="flex-shrink-0">
                                                @if ($enrollment->course->thumbnail)
                                                    <img src="{{ Storage::url($enrollment->course->thumbnail) }}"
                                                        alt="{{ $enrollment->course->title }}"
                                                        class="w-24 h-24 rounded-lg object-cover shadow-sm group-hover:shadow-md transition">
                                                @else
                                                    <div
                                                        class="w-24 h-24 rounded-lg bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-sm group-hover:shadow-md transition">
                                                        <svg class="w-12 h-12 text-white" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <h3
                                                    class="font-bold text-gray-900 text-lg mb-2 group-hover:text-primary-600 transition">
                                                    {{ $enrollment->course->title }}
                                                </h3>

                                                <!-- Progress Info -->
                                                <div class="flex items-center gap-4 mb-3 text-sm text-gray-600">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span
                                                            class="font-semibold text-primary-600">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                                        <span class="ml-1">selesai</span>
                                                    </div>
                                                    <span class="text-gray-400">•</span>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>{{ $enrollment->course->modules->sum(function ($module) {return $module->lessons->count();}) }}
                                                            materi</span>
                                                    </div>
                                                </div>

                                                <!-- Progress Bar -->
                                                <div class="mb-3">
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-2.5 rounded-full transition-all duration-500"
                                                            style="width: {{ $enrollment->progress_percentage }}%"></div>
                                                    </div>
                                                </div>

                                                <!-- Last Activity -->
                                                <p class="text-xs text-gray-500 mb-3">
                                                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Terakhir diakses
                                                    {{ optional($enrollment->updated_at)->diffForHumans() ?? 'baru saja' }}
                                                </p>
                                            </div>

                                            <!-- Action Button -->
                                            <div class="flex-shrink-0">
                                                <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                                    class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-sm hover:shadow-md group-hover:scale-105">
                                                    <span>Lanjutkan</span>
                                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-16">
                                <div
                                    class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full p-6 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">Belum Ada Kursus Aktif</h3>
                                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                                    Mulai perjalanan pembelajaran Anda dengan memilih kursus yang sesuai dengan kebutuhan
                                </p>
                                <a href="{{ route('courses.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-md hover:shadow-lg">
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-200">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pencapaian Anda
                                </h2>
                                <span class="text-sm font-semibold text-green-700">
                                    🎉 {{ $completedCourses->count() }} Kursus Selesai
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($completedCourses->take(4) as $enrollment)
                                    <div
                                        class="group border border-gray-200 rounded-xl p-4 hover:border-green-300 hover:shadow-md transition bg-gradient-to-br from-white to-green-50/30">
                                        <div class="flex items-center justify-between mb-3">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Selesai
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ optional($enrollment->completed_at)->format('d M Y') ?? (optional($enrollment->updated_at)->format('d M Y') ?? (optional($enrollment->created_at)->format('d M Y') ?? '-')) }}
                                            </span>
                                        </div>
                                        <h3
                                            class="font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-green-600 transition">
                                            {{ $enrollment->course->title }}
                                        </h3>
                                        <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                            class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-semibold">
                                            Lihat Kursus
                                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
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
                                        class="text-green-600 hover:text-green-700 font-semibold text-sm">
                                        Lihat Semua Pencapaian ({{ $completedCourses->count() }}) →
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
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-700 px-5 py-4">
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
                                                    class="p-2.5 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                </div>
                                            @elseif($activity->activity_type === 'lesson_completed')
                                                <div
                                                    class="p-2.5 bg-green-100 rounded-lg group-hover:bg-green-200 transition">
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <p class="text-sm font-medium text-gray-900">
                                                @if ($activity->activity_type === 'course_enrolled')
                                                    Mendaftar kursus baru
                                                @elseif($activity->activity_type === 'lesson_completed')
                                                    Menyelesaikan materi
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1 flex items-center">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
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
                                    class="bg-gray-100 rounded-full p-4 w-16 h-16 mx-auto mb-3 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm">Belum ada aktivitas</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-start mb-4">
                        <div class="bg-white/20 rounded-lg p-3 mr-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2">Mulai Belajar</h3>
                            <p class="text-primary-100 text-sm">
                                Jelajahi berbagai kursus IT dan tingkatkan skill Anda
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('courses.index') }}"
                        class="block w-full text-center px-5 py-3 bg-white text-primary-600 font-bold rounded-lg hover:bg-primary-50 transition shadow-md hover:shadow-lg">
                        Lihat Semua Kursus
                    </a>
                </div>

                <!-- Learning Tips -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200 p-5">
                    <div class="flex items-start mb-3">
                        <div class="bg-amber-200 rounded-lg p-2 mr-3">
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-900 mb-2">Tips Belajar</h4>
                            <ul class="space-y-1.5 text-sm text-amber-800">
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
