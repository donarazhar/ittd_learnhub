@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <!-- Course Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-hero-pattern opacity-5"></div>

        <!-- Decorative Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-primary-400/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-16">
            <div class="lg:grid lg:grid-cols-3 lg:gap-12">
                <!-- Left Content -->
                <div class="lg:col-span-2">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center space-x-2 text-sm mb-6">
                        <a href="{{ route('courses.index') }}"
                            class="text-white/60 hover:text-white transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Kursus
                        </a>
                        <svg class="w-4 h-4 text-white/40" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-white/80 truncate max-w-xs">{{ $course->title }}</span>
                    </nav>

                    <!-- Course Meta Badges -->
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <!-- Level Badge -->
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold shadow-lg
                            {{ $course->level === 'beginner' ? 'bg-emerald-500 text-white' : '' }}
                            {{ $course->level === 'intermediate' ? 'bg-amber-500 text-white' : '' }}
                            {{ $course->level === 'advanced' ? 'bg-rose-500 text-white' : '' }}">
                            {{ ucfirst($course->level) }}
                        </span>

                        <!-- Rating -->
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
                            <svg class="w-5 h-5 text-amber-400 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm font-bold">{{ number_format($course->average_rating, 1) }}</span>
                            <span class="text-sm text-white/60 ml-1">({{ $course->reviews->count() }} review)</span>
                        </div>

                        <!-- Students -->
                        <div
                            class="flex items-center bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10">
                            <svg class="w-5 h-5 text-primary-300 mr-1.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium">{{ $course->total_enrolled }} Peserta</span>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-5 leading-tight">
                        {{ $course->title }}
                    </h1>

                    <!-- Description -->
                    <p class="text-lg text-white/80 mb-8 leading-relaxed max-w-2xl">
                        {{ Str::limit(strip_tags($course->description), 200) }}
                    </p>

                    <!-- Instructor Info -->
                    <div class="flex items-center">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg border-2 border-white/20">
                            {{ substr($course->creator->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-white/60 mb-0.5">Dibuat oleh</p>
                            <p class="font-semibold text-lg">{{ $course->creator->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right - Course Image (Desktop Only) -->
                <div class="hidden lg:block lg:col-span-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                        @if ($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                class="w-full h-auto">
                        @else
                            <div
                                class="w-full aspect-video bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        <!-- Play Overlay -->
                        <div
                            class="absolute inset-0 bg-dark-900/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <div
                                class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="bg-gray-50 py-8 sm:py-10 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2" x-data="{ activeTab: 'curriculum' }">
                    <!-- Tab Navigation -->
                    <div class="card mb-6 overflow-hidden">
                        <div class="flex overflow-x-auto scrollbar-thin border-b border-gray-100">
                            <button @click="activeTab = 'curriculum'"
                                :class="activeTab === 'curriculum' ? 'border-primary-500 text-primary-600 bg-primary-50/50' :
                                    'border-transparent text-dark-400 hover:text-dark-600 hover:border-gray-300'"
                                class="flex-shrink-0 px-6 py-4 border-b-2 font-semibold text-sm whitespace-nowrap transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kurikulum
                            </button>
                            <button @click="activeTab = 'overview'"
                                :class="activeTab === 'overview' ? 'border-primary-500 text-primary-600 bg-primary-50/50' :
                                    'border-transparent text-dark-400 hover:text-dark-600 hover:border-gray-300'"
                                class="flex-shrink-0 px-6 py-4 border-b-2 font-semibold text-sm whitespace-nowrap transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Overview
                            </button>
                            <button @click="activeTab = 'reviews'"
                                :class="activeTab === 'reviews' ? 'border-primary-500 text-primary-600 bg-primary-50/50' :
                                    'border-transparent text-dark-400 hover:text-dark-600 hover:border-gray-300'"
                                class="flex-shrink-0 px-6 py-4 border-b-2 font-semibold text-sm whitespace-nowrap transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Review ({{ $course->reviews->count() }})
                            </button>
                            <button @click="activeTab = 'discussion'"
                                :class="activeTab === 'discussion' ? 'border-primary-500 text-primary-600 bg-primary-50/50' :
                                    'border-transparent text-dark-400 hover:text-dark-600 hover:border-gray-300'"
                                class="flex-shrink-0 px-6 py-4 border-b-2 font-semibold text-sm whitespace-nowrap transition-all duration-200 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                                Diskusi
                            </button>
                        </div>
                    </div>

                    <!-- Tab Content -->
                    <div class="card p-6 sm:p-8">
                        <!-- Curriculum Tab -->
                        <div x-show="activeTab === 'curriculum'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <h2 class="text-2xl font-bold text-dark-800 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                Materi Kursus
                            </h2>

                            @if ($course->modules->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($course->modules as $moduleIndex => $module)
                                        <div class="border border-gray-200 rounded-2xl overflow-hidden hover:border-primary-200 transition-colors"
                                            x-data="{ open: {{ $moduleIndex === 0 ? 'true' : 'false' }} }">
                                            <!-- Module Header -->
                                            <button @click="open = !open"
                                                class="w-full px-5 sm:px-6 py-4 bg-gradient-to-r from-gray-50 to-white hover:from-primary-50 hover:to-white transition-all flex items-center justify-between group">
                                                <div class="flex items-center flex-1 text-left">
                                                    <div
                                                        class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center mr-4 shadow-lg group-hover:scale-105 transition-transform">
                                                        <span class="text-white font-bold">{{ $moduleIndex + 1 }}</span>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <h3
                                                            class="text-base sm:text-lg font-bold text-dark-800 group-hover:text-primary-600 transition-colors truncate">
                                                            {{ $module->title }}</h3>
                                                        @if ($module->description)
                                                            <p class="text-sm text-dark-400 mt-0.5 line-clamp-1">
                                                                {{ strip_tags($module->description) }}</p>
                                                        @endif
                                                        <p class="text-xs text-dark-300 mt-1 flex items-center">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                            </svg>
                                                            {{ $module->lessons->count() }} Materi
                                                        </p>
                                                    </div>
                                                </div>
                                                <svg class="w-5 h-5 text-dark-400 transform transition-transform duration-200 flex-shrink-0 ml-4"
                                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Lessons List -->
                                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-2"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="border-t border-gray-100">
                                                @if ($module->lessons->count() > 0)
                                                    <ul class="divide-y divide-gray-50">
                                                        @foreach ($module->lessons as $lesson)
                                                            <li
                                                                class="px-5 sm:px-6 py-4 hover:bg-primary-50/50 transition-colors flex items-center justify-between group">
                                                                <div class="flex items-center flex-1 min-w-0">
                                                                    <!-- Icon -->
                                                                    @if ($lesson->video_url)
                                                                        <div
                                                                            class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary-200 transition-colors">
                                                                            <svg class="w-5 h-5 text-primary-600"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                            </svg>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-gray-200 transition-colors">
                                                                            <svg class="w-5 h-5 text-dark-400"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                            </svg>
                                                                        </div>
                                                                    @endif

                                                                    <!-- Title -->
                                                                    <span
                                                                        class="text-dark-700 font-medium group-hover:text-primary-600 transition-colors truncate">{{ $lesson->title }}</span>
                                                                </div>

                                                                <!-- Completion Badge -->
                                                                @if ($userEnrollment && $lesson->isCompletedBy(auth()->user()))
                                                                    <div
                                                                        class="flex items-center text-emerald-600 text-sm font-semibold flex-shrink-0 ml-4">
                                                                        <svg class="w-5 h-5 mr-1" fill="currentColor"
                                                                            viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd"
                                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                        <span class="hidden sm:inline">Selesai</span>
                                                                    </div>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div
                                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-dark-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-dark-400">Belum ada materi yang ditambahkan.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Overview Tab -->
                        <div x-show="activeTab === 'overview'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-dark-800 mb-6">Tentang Kursus Ini</h2>

                            <div class="prose max-w-none text-dark-600 leading-relaxed mb-8">
                                <p>{{ strip_tags($course->description) }}</p>
                            </div>

                            <!-- What You'll Learn -->
                            <div
                                class="bg-gradient-to-br from-primary-50 to-primary-100/50 rounded-2xl p-6 mb-8 border border-primary-100">
                                <h3 class="text-xl font-bold text-dark-800 mb-4 flex items-center">
                                    <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    Yang Akan Anda Pelajari
                                </h3>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($course->modules as $module)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-dark-700">{{ $module->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Requirements -->
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-dark-800 mb-4">Persyaratan</h3>
                                <ul class="space-y-3">
                                    <li class="flex items-start text-dark-600">
                                        <svg class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Koneksi internet yang stabil
                                    </li>
                                    <li class="flex items-start text-dark-600">
                                        <svg class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Akun pegawai ITTD YPI Al-Azhar
                                    </li>
                                    <li class="flex items-start text-dark-600">
                                        <svg class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Kemauan untuk belajar dan berlatih
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div x-show="activeTab === 'reviews'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-dark-800 mb-6">Review Peserta</h2>

                            @if ($course->reviews->count() > 0)
                                <div class="space-y-6">
                                    @foreach ($course->reviews->take(10) as $review)
                                        <div
                                            class="flex items-start pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                                            <!-- Avatar -->
                                            <div
                                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>

                                            <div class="ml-4 flex-1">
                                                <div
                                                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2 gap-1">
                                                    <h4 class="font-bold text-dark-800">{{ $review->user->name }}</h4>
                                                    <span
                                                        class="text-sm text-dark-400">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>

                                                <!-- Stars -->
                                                <div class="flex items-center mb-3">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>

                                                @if ($review->review)
                                                    <p class="text-dark-600 leading-relaxed">{{ $review->review }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div
                                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-dark-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    </div>
                                    <p class="text-dark-400">Belum ada review untuk kursus ini.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Discussion Tab -->
                        <div x-show="activeTab === 'discussion'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-dark-800 mb-6">Forum Diskusi</h2>

                            <div class="text-center py-12">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-primary-100 rounded-2xl flex items-center justify-center">
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                    </svg>
                                </div>
                                <p class="text-dark-400 mb-4">Forum diskusi untuk kursus ini.</p>
                                <a href="{{ route('forum.index') }}"
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 font-semibold group">
                                    Kunjungi Forum
                                    <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <div class="card p-6 sticky top-24">
                        @if ($userEnrollment)
                            <!-- Enrolled - Progress Section -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-semibold text-dark-500">Progress Pembelajaran</span>
                                    <span
                                        class="text-lg font-bold text-primary-600">{{ number_format($userEnrollment->progress_percentage, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500 shadow-sm"
                                        style="width: {{ $userEnrollment->progress_percentage }}%"></div>
                                </div>
                                <p class="text-xs text-dark-400 mt-2">
                                    {{ $userEnrollment->completed_lessons_count }} dari
                                    {{ $course->getTotalLessonsAttribute() }} materi selesai
                                </p>
                            </div>

                            <!-- CTA Buttons -->
                            @if ($userEnrollment->last_accessed_lesson_id)
                                <a href="{{ route('learn.show', [$course->slug, $userEnrollment->lastAccessedLesson->slug]) }}"
                                    class="btn-primary w-full py-3.5 mb-3 group">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lanjutkan Belajar
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                @php $firstLesson = $course->modules->first()?->lessons->first(); @endphp
                                @if ($firstLesson)
                                    <a href="{{ route('learn.show', [$course->slug, $firstLesson->slug]) }}"
                                        class="btn-primary w-full py-3.5 mb-3 group">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Mulai Belajar
                                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                @endif
                            @endif

                            <!-- Completion Badge -->
                            @if ($userEnrollment->completed_at)
                                <div
                                    class="flex items-center justify-center px-4 py-3 bg-emerald-50 border-2 border-emerald-200 rounded-xl mb-6">
                                    <svg class="w-6 h-6 text-emerald-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-emerald-800 font-bold">Kursus Selesai! 🎉</span>
                                </div>
                            @endif
                        @else
                            <!-- Not Enrolled - Enrollment CTA -->
                            <div class="text-center mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl mb-4 shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="text-4xl font-bold text-dark-800 mb-1">GRATIS</div>
                                <p class="text-sm text-dark-400">Khusus Pegawai ITTD</p>
                            </div>

                            <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                @csrf
                                <button type="submit" class="btn-primary w-full py-4 text-base font-bold mb-4 group">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Daftar Sekarang
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </form>

                            <p class="text-center text-xs text-dark-400 mb-6">
                                Dengan mendaftar, Anda akan mendapatkan akses penuh ke semua materi
                            </p>
                        @endif

                        <!-- Course Includes -->
                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="font-bold text-dark-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                Kursus Ini Termasuk:
                            </h3>
                            <ul class="space-y-3">
                                <li class="flex items-center text-sm text-dark-600">
                                    <div
                                        class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Akses selamanya
                                </li>
                                <li class="flex items-center text-sm text-dark-600">
                                    <div
                                        class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Forum diskusi dengan instruktur
                                </li>
                                <li class="flex items-center text-sm text-dark-600">
                                    <div
                                        class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    Belajar dengan kecepatan Anda sendiri
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush
