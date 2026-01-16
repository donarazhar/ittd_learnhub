@extends('layouts.app')

@section('title', 'Kursus Saya')

@section('content')
    <!-- Hero Header Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-primary-50/30">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-hero-pattern opacity-30"></div>

        <!-- Decorative Elements -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-primary-200/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-primary-100/40 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-16">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                <div>
                    <div class="badge-primary mb-4">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Pembelajaran Saya
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark-800 mb-3">
                        Kursus <span class="text-gradient">Saya</span>
                    </h1>
                    <p class="text-lg text-dark-400 max-w-xl">
                        Pantau progress dan lanjutkan perjalanan pembelajaran Anda
                    </p>
                </div>

                <!-- Quick Action Button -->
                <a href="{{ route('courses.index') }}" class="btn-primary py-4 px-6 group hidden sm:inline-flex">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kursus
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        @if ($enrollments->count() > 0)
            <!-- Stats Dashboard -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 -mt-8 relative z-10">
                <!-- Total Kursus -->
                <div class="card p-5 sm:p-6 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-dark-400 mb-1">Total Kursus</p>
                            <p class="text-2xl sm:text-3xl font-bold text-dark-800">{{ $enrollments->total() }}</p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sedang Belajar -->
                <div class="card p-5 sm:p-6 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-dark-400 mb-1">Sedang Belajar</p>
                            <p class="text-2xl sm:text-3xl font-bold text-dark-800">
                                {{ $enrollments->where('completed_at', null)->count() }}
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Selesai -->
                <div class="card p-5 sm:p-6 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-dark-400 mb-1">Selesai</p>
                            <p class="text-2xl sm:text-3xl font-bold text-dark-800">
                                {{ $enrollments->whereNotNull('completed_at')->count() }}
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Progress -->
                <div class="card p-5 sm:p-6 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-dark-400 mb-1">Rata-rata Progress</p>
                            <p class="text-2xl sm:text-3xl font-bold text-dark-800">
                                {{ number_format($enrollments->avg('progress_percentage'), 0) }}%
                            </p>
                        </div>
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters/Tabs -->
            <div class="card p-4 sm:p-5 mb-6" x-data="{ activeTab: 'all' }">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <!-- Tab Buttons -->
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <button @click="activeTab = 'all'"
                            :class="activeTab === 'all' ? 'bg-primary-600 text-white shadow-lg' :
                                'bg-gray-100 text-dark-600 hover:bg-gray-200'"
                            class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 touch-manipulation">
                            Semua Kursus
                        </button>
                        <button @click="activeTab = 'progress'"
                            :class="activeTab === 'progress' ? 'bg-primary-600 text-white shadow-lg' :
                                'bg-gray-100 text-dark-600 hover:bg-gray-200'"
                            class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 touch-manipulation">
                            Sedang Belajar
                        </button>
                        <button @click="activeTab = 'completed'"
                            :class="activeTab === 'completed' ? 'bg-primary-600 text-white shadow-lg' :
                                'bg-gray-100 text-dark-600 hover:bg-gray-200'"
                            class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 touch-manipulation">
                            Selesai
                        </button>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="flex items-center gap-3">
                        <label class="text-sm text-dark-400 font-medium">Urutkan:</label>
                        <select
                            class="px-4 py-2.5 bg-gray-100 border-0 rounded-xl text-sm font-medium text-dark-700 focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all">
                            <option>Terbaru</option>
                            <option>Progress</option>
                            <option>Nama A-Z</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Course Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @foreach ($enrollments as $enrollment)
                    <article class="group card overflow-hidden card-hover">
                        <!-- Thumbnail -->
                        <div class="relative h-44 sm:h-48 overflow-hidden">
                            @if ($enrollment->course->thumbnail)
                                <img src="{{ Storage::url($enrollment->course->thumbnail) }}"
                                    alt="{{ $enrollment->course->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div class="absolute top-4 left-4">
                                @if ($enrollment->completed_at)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-500/90 text-white backdrop-blur-sm shadow-lg">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Selesai
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-500/90 text-white backdrop-blur-sm shadow-lg">
                                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Dalam Progress
                                    </span>
                                @endif
                            </div>

                            <!-- Progress Overlay -->
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-dark-900/80 via-dark-900/40 to-transparent p-4">
                                <div class="flex items-center justify-between text-white text-sm font-medium mb-2">
                                    <span>Progress</span>
                                    <span
                                        class="text-lg font-bold">{{ number_format($enrollment->progress_percentage, 0) }}%</span>
                                </div>
                                <div class="w-full bg-white/30 rounded-full h-2 overflow-hidden backdrop-blur-sm">
                                    <div class="h-2 rounded-full transition-all duration-500 {{ $enrollment->completed_at ? 'bg-emerald-400' : 'bg-white' }}"
                                        style="width: {{ $enrollment->progress_percentage }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 sm:p-6">
                            <!-- Title -->
                            <h3
                                class="text-lg sm:text-xl font-bold text-dark-800 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2 leading-tight">
                                {{ $enrollment->course->title }}
                            </h3>

                            <!-- Description -->
                            <p class="text-dark-400 text-sm mb-4 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($enrollment->course->description), 100) }}
                            </p>

                            <!-- Meta Info -->
                            <div
                                class="flex items-center justify-between text-xs text-dark-400 mb-5 pb-5 border-b border-gray-100">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-dark-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $enrollment->enrolled_at->format('d M Y') }}</span>
                                </div>
                                @if ($enrollment->completed_at)
                                    <div class="flex items-center gap-1.5 text-emerald-600 font-semibold">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Tersertifikasi</span>
                                    </div>
                                @endif
                            </div>

                            <!-- CTA Button -->
                            <a href="{{ route('courses.show', $enrollment->course->slug) }}"
                                class="btn-primary w-full py-3 text-sm group/btn">
                                @if ($enrollment->completed_at)
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Tinjau Kursus
                                @else
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lanjutkan Belajar
                                @endif
                                <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($enrollments->hasPages())
                <div class="mt-10">
                    {{ $enrollments->links() }}
                </div>
            @endif
        @else
            <!-- Enhanced Empty State -->
            <div
                class="card p-8 sm:p-12 lg:p-16 text-center border-2 border-dashed border-gray-200 bg-gradient-to-br from-white to-gray-50">
                <!-- Icon -->
                <div
                    class="w-24 h-24 sm:w-28 sm:h-28 mx-auto mb-8 bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl flex items-center justify-center shadow-soft">
                    <svg class="w-12 h-12 sm:w-14 sm:h-14 text-primary-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>

                <!-- Content -->
                <h3 class="text-2xl sm:text-3xl font-bold text-dark-800 mb-4">Belum Ada Kursus</h3>
                <p class="text-lg text-dark-400 mb-8 max-w-md mx-auto leading-relaxed">
                    Anda belum terdaftar di kursus manapun. Mulai perjalanan belajar Anda sekarang!
                </p>

                <!-- CTA Button -->
                <a href="{{ route('courses.index') }}" class="btn-primary py-4 px-8 text-base group">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Kursus
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Benefits -->
                <div class="mt-14 grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 max-w-3xl mx-auto">
                    <div class="text-center p-4">
                        <div class="w-14 h-14 mx-auto mb-4 bg-primary-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-dark-800 mb-2">Video HD</h4>
                        <p class="text-sm text-dark-400">Tutorial berkualitas tinggi</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="w-14 h-14 mx-auto mb-4 bg-emerald-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-dark-800 mb-2">Sertifikat</h4>
                        <p class="text-sm text-dark-400">Dapatkan sertifikat digital</p>
                    </div>

                    <div class="text-center p-4">
                        <div class="w-14 h-14 mx-auto mb-4 bg-violet-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-dark-800 mb-2">Fleksibel</h4>
                        <p class="text-sm text-dark-400">Belajar kapan saja</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Mobile FAB -->
    <a href="{{ route('courses.index') }}"
        class="sm:hidden fixed bottom-6 right-6 z-40 w-14 h-14 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 flex items-center justify-center touch-manipulation safe-area-bottom">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </a>
@endsection
