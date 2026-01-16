@extends('layouts.app')

@section('title', 'Katalog Kursus')

@section('content')
    <!-- Hero Header Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <!-- Header Title -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-sm font-medium mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Katalog Pembelajaran IT
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                    Temukan Kursus Terbaik
                </h1>
                <p class="text-lg text-primary-100 max-w-2xl mx-auto">
                    Jelajahi <span class="font-semibold text-white">{{ $courses->total() }}</span> kursus berkualitas untuk
                    meningkatkan skill IT Anda
                </p>
            </div>

            <!-- Search Box -->
            <div class="max-w-3xl mx-auto">
                <form method="GET" action="{{ route('courses.index') }}">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-dark-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kursus berdasarkan judul atau deskripsi..."
                            class="block w-full pl-14 pr-36 py-4 sm:py-5 bg-white border-0 rounded-2xl text-dark-800 text-base sm:text-lg placeholder-dark-300 shadow-xl focus:ring-4 focus:ring-white/30 transition-all">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="submit"
                                class="px-6 sm:px-8 py-2.5 sm:py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-all shadow-lg hover:shadow-xl">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Quick Filters Below Search -->
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                        <span class="text-primary-200 text-sm font-medium hidden sm:inline">Filter:</span>

                        <!-- Level Buttons -->
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('courses.index', array_merge(request()->except('level'), ['level' => ''])) }}"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ !request('level') ? 'bg-white text-primary-700 shadow-lg' : 'bg-white/10 text-white hover:bg-white/20 border border-white/20' }}">
                                Semua Level
                            </a>
                            <a href="{{ route('courses.index', array_merge(request()->all(), ['level' => 'beginner'])) }}"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('level') === 'beginner' ? 'bg-emerald-500 text-white shadow-lg' : 'bg-white/10 text-white hover:bg-white/20 border border-white/20' }}">
                                🟢 Beginner
                            </a>
                            <a href="{{ route('courses.index', array_merge(request()->all(), ['level' => 'intermediate'])) }}"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('level') === 'intermediate' ? 'bg-amber-500 text-white shadow-lg' : 'bg-white/10 text-white hover:bg-white/20 border border-white/20' }}">
                                🟡 Intermediate
                            </a>
                            <a href="{{ route('courses.index', array_merge(request()->all(), ['level' => 'advanced'])) }}"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all {{ request('level') === 'advanced' ? 'bg-rose-500 text-white shadow-lg' : 'bg-white/10 text-white hover:bg-white/20 border border-white/20' }}">
                                🔴 Advanced
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Courses Content Section -->
    <section class="py-10 sm:py-12 lg:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Results Header with Sort -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-dark-800 mb-1">
                        @if (request('search'))
                            Hasil Pencarian
                        @elseif(request('level'))
                            Kursus {{ ucfirst(request('level')) }}
                        @else
                            Semua Kursus
                        @endif
                    </h2>
                    <p class="text-dark-400">
                        Menampilkan <span class="font-semibold text-primary-600">{{ $courses->count() }}</span> dari
                        <span class="font-semibold text-primary-600">{{ $courses->total() }}</span> kursus
                    </p>
                </div>

                <!-- Sort Dropdown -->
                <div class="flex items-center gap-3">
                    <label class="text-sm text-dark-500 font-medium whitespace-nowrap">Urutkan:</label>
                    <form method="GET" action="{{ route('courses.index') }}" id="sortForm">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request('level'))
                            <input type="hidden" name="level" value="{{ request('level') }}">
                        @endif
                        <select name="sort" onchange="document.getElementById('sortForm').submit()"
                            class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-dark-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 cursor-pointer min-w-[160px]">
                            <option value="" {{ !request('sort') ? 'selected' : '' }}>Terbaru</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Terpopuler
                            </option>
                            <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Rating Tertinggi
                            </option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Nama A-Z</option>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Active Filters -->
            @if (request('search') || request('level'))
                <div class="mb-6 flex flex-wrap items-center gap-2">
                    <span class="text-sm text-dark-400">Filter aktif:</span>

                    @if (request('search'))
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary-100 text-primary-700 rounded-lg text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            "{{ Str::limit(request('search'), 20) }}"
                            <a href="{{ route('courses.index', array_merge(request()->except('search'))) }}"
                                class="hover:text-primary-900 ml-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </span>
                    @endif

                    @if (request('level'))
                        <span
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-medium
                            {{ request('level') === 'beginner' ? 'bg-emerald-100 text-emerald-700' : '' }}
                            {{ request('level') === 'intermediate' ? 'bg-amber-100 text-amber-700' : '' }}
                            {{ request('level') === 'advanced' ? 'bg-rose-100 text-rose-700' : '' }}">
                            {{ ucfirst(request('level')) }}
                            <a href="{{ route('courses.index', array_merge(request()->except('level'))) }}"
                                class="hover:opacity-70 ml-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </span>
                    @endif

                    <a href="{{ route('courses.index') }}"
                        class="text-sm text-primary-600 hover:text-primary-700 font-medium ml-2">
                        Reset Semua
                    </a>
                </div>
            @endif

            <!-- Courses Grid -->
            @if ($courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach ($courses as $course)
                        <article
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-soft hover:shadow-xl hover:border-primary-200 transition-all duration-300 hover:-translate-y-1">
                            <!-- Thumbnail -->
                            <div class="relative h-48 sm:h-52 overflow-hidden">
                                @if ($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
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

                                <!-- Badges Overlay -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold backdrop-blur-md shadow-sm
                                        {{ $course->level === 'beginner' ? 'bg-emerald-500/90 text-white' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-amber-500/90 text-white' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-rose-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>

                                <!-- Enrolled Badge -->
                                @if (auth()->check() && auth()->user()->hasEnrolled($course))
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-500/90 text-white backdrop-blur-md shadow-sm">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Terdaftar
                                        </span>
                                    </div>
                                @endif

                                <!-- Hover Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-dark-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6">
                                    <span
                                        class="px-4 py-2 bg-white/90 backdrop-blur-sm text-dark-800 font-semibold rounded-lg text-sm">
                                        Lihat Detail →
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 sm:p-6">
                                <!-- Title -->
                                <h3
                                    class="text-lg sm:text-xl font-bold text-dark-800 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2 leading-tight">
                                    {{ $course->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-dark-400 text-sm mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                <!-- Instructor -->
                                <div class="flex items-center mb-4 pb-4 border-b border-gray-100">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white text-sm font-bold mr-3 shadow-sm">
                                        {{ substr($course->creator->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-dark-300">Instruktur</p>
                                        <p class="text-sm text-dark-600 font-medium truncate">{{ $course->creator->name }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="flex items-center justify-between text-sm text-dark-400 mb-5">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-dark-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span>{{ $course->total_enrolled }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-medium">{{ number_format($course->average_rating, 1) }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-dark-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $course->getTotalLessonsAttribute() }} materi</span>
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="btn-primary w-full py-3 text-sm group/btn">
                                    Lihat Detail
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
                @if ($courses->hasPages())
                    <div class="mt-10">
                        {{ $courses->links() }}
                    </div>
                @endif
            @else
                <!-- Enhanced Empty State -->
                <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-8 sm:p-12 lg:p-16 text-center">
                    <div
                        class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-dark-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-dark-800 mb-3">Tidak Ada Kursus Ditemukan</h3>
                    <p class="text-dark-400 mb-8 max-w-md mx-auto">
                        @if (request('search'))
                            Tidak ditemukan hasil untuk pencarian "<strong
                                class="text-dark-600">{{ request('search') }}</strong>". Coba kata kunci lain atau ubah
                            filter Anda.
                        @else
                            Coba ubah filter atau kata kunci pencarian Anda untuk menemukan kursus yang sesuai.
                        @endif
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('courses.index') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Lihat Semua Kursus
                        </a>

                        <button onclick="window.history.back()" class="btn-secondary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
