@extends('layouts.app')

@section('title', 'Katalog Kursus')

@section('content')
    {{-- Modern Header with Gradient & Integrated Filter --}}
    <div class="bg-gradient-to-br from-primary-50 via-white to-purple-50 py-8 sm:py-12 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Title --}}
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-2 sm:mb-3">
                    Katalog Kursus IT
                </h1>
                <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi {{ $courses->total() }} kursus berkualitas untuk meningkatkan skill IT Anda
                </p>
            </div>

            {{-- Integrated Filter & Search --}}
            <div
                class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-200 shadow-lg p-4 sm:p-6 max-w-5xl mx-auto">
                <form method="GET" action="{{ route('courses.index') }}">
                    {{-- Search Bar --}}
                    <div class="mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kursus berdasarkan judul atau deskripsi..."
                                class="block w-full pl-12 pr-4 py-3 sm:py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm sm:text-base">
                        </div>
                    </div>

                    {{-- Filters Row - Mobile Optimized --}}
                    <div class="flex flex-col sm:flex-row gap-3">
                        {{-- Level Filter --}}
                        <select name="level"
                            class="flex-1 px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                            <option value="">📚 Semua Level</option>
                            <option value="beginner" {{ request('level') === 'beginner' ? 'selected' : '' }}>🟢 Beginner
                            </option>
                            <option value="intermediate" {{ request('level') === 'intermediate' ? 'selected' : '' }}>🟡
                                Intermediate</option>
                            <option value="advanced" {{ request('level') === 'advanced' ? 'selected' : '' }}>🔴 Advanced
                            </option>
                        </select>

                        {{-- Sort Filter --}}
                        <select name="sort"
                            class="flex-1 px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm">
                            <option value="">📊 Urutkan</option>
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>🆕 Terbaru</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>🔥 Terpopuler
                            </option>
                            <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>⭐ Rating Tertinggi
                            </option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>🔤 Nama A-Z</option>
                        </select>

                        {{-- Buttons --}}
                        <button type="submit"
                            class="px-6 py-2.5 sm:py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-lg hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="hidden sm:inline">Cari</span>
                        </button>

                        @if (request('search') || request('level') || request('sort'))
                            <a href="{{ route('courses.index') }}"
                                class="px-4 sm:px-6 py-2.5 sm:py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center active:scale-95 touch-manipulation"
                                title="Reset Filter">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="hidden sm:inline ml-1">Reset</span>
                            </a>
                        @endif
                    </div>

                    {{-- Active Filters Display --}}
                    @if (request('search') || request('level') || request('sort'))
                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <span class="text-xs sm:text-sm text-gray-600 font-medium">Filter aktif:</span>

                            @if (request('search'))
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs sm:text-sm">
                                    🔍 "{{ Str::limit(request('search'), 20) }}"
                                    <a href="{{ route('courses.index', array_merge(request()->except('search'))) }}"
                                        class="ml-2 hover:text-primary-900 font-bold">×</a>
                                </span>
                            @endif

                            @if (request('level'))
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs sm:text-sm">
                                    📚 {{ ucfirst(request('level')) }}
                                    <a href="{{ route('courses.index', array_merge(request()->except('level'))) }}"
                                        class="ml-2 hover:text-blue-900 font-bold">×</a>
                                </span>
                            @endif

                            @if (request('sort'))
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs sm:text-sm">
                                    📊 {{ ucfirst(request('sort')) }}
                                    <a href="{{ route('courses.index', array_merge(request()->except('sort'))) }}"
                                        class="ml-2 hover:text-green-900 font-bold">×</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Courses Content Section --}}
    <div class="bg-gray-50 py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Results Info --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                    Menampilkan <span class="text-primary-600">{{ $courses->count() }}</span> dari <span
                        class="text-primary-600">{{ $courses->total() }}</span> kursus
                </h2>
            </div>

            {{-- Courses Grid --}}
            @if ($courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($courses as $course)
                        <div
                            class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:border-primary-300 transition transform hover:-translate-y-1 active:scale-98 touch-manipulation">
                            {{-- Thumbnail --}}
                            <div class="relative h-48 sm:h-52 overflow-hidden">
                                @if ($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                        loading="lazy">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 flex items-center justify-center">
                                        <svg class="w-16 sm:w-20 h-16 sm:h-20 text-white opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Badges Overlay --}}
                                <div class="absolute top-3 sm:top-4 left-3 sm:left-4 flex gap-2">
                                    <span
                                        class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                                        {{ $course->level === 'beginner' ? 'bg-green-500/90 text-white' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-yellow-500/90 text-white' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-red-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>

                                {{-- Enrolled Badge --}}
                                @if (auth()->check() && auth()->user()->hasEnrolled($course))
                                    <div class="absolute top-3 sm:top-4 right-3 sm:right-4">
                                        <span
                                            class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/90 text-white backdrop-blur-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Terdaftar
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="p-5 sm:p-6">
                                <h3
                                    class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-primary-600 transition line-clamp-2 leading-tight">
                                    {{ $course->title }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                {{-- Instructor --}}
                                <div class="flex items-center mb-4 pb-4 border-b border-gray-100">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold mr-2 flex-shrink-0">
                                        {{ substr($course->creator->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm text-gray-600 truncate">{{ $course->creator->name }}</span>
                                </div>

                                {{-- Stats --}}
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-5 sm:mb-6">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $course->total_enrolled }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ number_format($course->average_rating, 1) }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        {{ $course->getTotalLessonsAttribute() }}
                                    </div>
                                </div>

                                {{-- CTA Button --}}
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="group/btn flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                                    Lihat Detail
                                    <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($courses->hasPages())
                    <div class="mt-8">
                        {{ $courses->links() }}
                    </div>
                @endif
            @else
                {{-- Enhanced Empty State --}}
                <div class="bg-white rounded-2xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 rounded-full mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">Tidak Ada Kursus Ditemukan</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-6 max-w-md mx-auto">
                        @if (request('search'))
                            Tidak ditemukan hasil untuk pencarian "<strong>{{ request('search') }}</strong>".
                            Coba kata kunci lain atau ubah filter Anda.
                        @else
                            Coba ubah filter atau kata kunci pencarian Anda untuk menemukan kursus yang sesuai.
                        @endif
                    </p>

                    @if (request('search') || request('level') || request('sort'))
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('courses.index') }}"
                                class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset & Lihat Semua
                            </a>

                            <button onclick="window.history.back()"
                                class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition active:scale-95 touch-manipulation">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Touch optimization for mobile */
        .touch-manipulation {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .active\:scale-95:active {
            transform: scale(0.95);
        }

        .active\:scale-98:active {
            transform: scale(0.98);
        }
    </style>
@endpush
