@extends('layouts.app')

@section('title', $course->title)

@section('content')
    {{-- Modern Course Hero --}}
    <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-primary-500 rounded-full mix-blend-overlay filter blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500 rounded-full mix-blend-overlay filter blur-3xl">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Left Content --}}
                <div class="lg:col-span-2">
                    {{-- Breadcrumb --}}
                    <nav class="flex items-center space-x-2 text-sm mb-6">
                        <a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-white transition">Kursus</a>
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-400">{{ $course->title }}</span>
                    </nav>

                    {{-- Course Meta --}}
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        {{-- Level Badge --}}
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold backdrop-blur-sm
                            {{ $course->level === 'beginner' ? 'bg-green-500/90 text-white' : '' }}
                            {{ $course->level === 'intermediate' ? 'bg-yellow-500/90 text-white' : '' }}
                            {{ $course->level === 'advanced' ? 'bg-red-500/90 text-white' : '' }}">
                            {{ ucfirst($course->level) }}
                        </span>

                        {{-- Rating --}}
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-3 py-1 rounded-full">
                            <svg class="w-5 h-5 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm font-semibold">{{ number_format($course->average_rating, 1) }}</span>
                            <span class="text-sm text-gray-300 ml-1">({{ $course->reviews->count() }})</span>
                        </div>

                        {{-- Students --}}
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-3 py-1 rounded-full">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium">{{ $course->total_enrolled }} Peserta</span>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                        {{ $course->title }}
                    </h1>

                    {{-- FIXED: Strip HTML tags --}}
                    <p class="text-lg md:text-xl text-gray-300 mb-6 leading-relaxed">
                        {{ strip_tags($course->description) }}
                    </p>

                    {{-- Instructor Info --}}
                    <div class="flex items-center">
                        <div
                            class="h-12 w-12 rounded-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg mr-3">
                            {{ substr($course->creator->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Dibuat oleh</p>
                            <p class="font-semibold">{{ $course->creator->name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Right - Course Image (Desktop Only) --}}
                <div class="hidden lg:block lg:col-span-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        @if ($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                class="w-full h-auto">
                        @else
                            <div
                                class="w-full aspect-video bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    {{-- Tab Navigation --}}
                    <div class="bg-white rounded-t-xl border border-gray-200 border-b-0">
                        <div class="flex overflow-x-auto" x-data="{ activeTab: 'curriculum' }">
                            <button @click="activeTab = 'curriculum'"
                                :class="activeTab === 'curriculum' ? 'border-primary-600 text-primary-600' :
                                    'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap transition">
                                📚 Kurikulum
                            </button>
                            <button @click="activeTab = 'overview'"
                                :class="activeTab === 'overview' ? 'border-primary-600 text-primary-600' :
                                    'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap transition">
                                📖 Overview
                            </button>
                            <button @click="activeTab = 'reviews'"
                                :class="activeTab === 'reviews' ? 'border-primary-600 text-primary-600' :
                                    'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap transition">
                                ⭐ Review ({{ $course->reviews->count() }})
                            </button>
                            <button @click="activeTab = 'discussion'"
                                :class="activeTab === 'discussion' ? 'border-primary-600 text-primary-600' :
                                    'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300'"
                                class="px-6 py-4 border-b-2 font-medium text-sm whitespace-nowrap transition">
                                💬 Diskusi
                            </button>
                        </div>
                    </div>

                    {{-- Tab Content --}}
                    <div class="bg-white rounded-b-xl border border-gray-200 p-6" x-data="{ activeTab: 'curriculum' }">
                        {{-- Curriculum Tab --}}
                        <div x-show="activeTab === 'curriculum'" x-transition>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Materi Kursus</h2>

                            @if ($course->modules->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($course->modules as $moduleIndex => $module)
                                        <div class="border border-gray-200 rounded-xl overflow-hidden"
                                            x-data="{ open: {{ $moduleIndex === 0 ? 'true' : 'false' }} }">
                                            {{-- Module Header --}}
                                            <button @click="open = !open"
                                                class="w-full px-6 py-4 bg-gray-50 hover:bg-gray-100 transition flex items-center justify-between">
                                                <div class="flex items-center flex-1 text-left">
                                                    <div
                                                        class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                                                        <span
                                                            class="text-primary-600 font-bold">{{ $moduleIndex + 1 }}</span>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-lg font-bold text-gray-900">{{ $module->title }}
                                                        </h3>
                                                        @if ($module->description)
                                                            <p class="text-sm text-gray-600 mt-0.5">
                                                                {{ strip_tags($module->description) }}</p>
                                                        @endif
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            {{ $module->lessons->count() }} Materi</p>
                                                    </div>
                                                </div>
                                                <svg class="w-5 h-5 text-gray-400 transform transition"
                                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            {{-- Lessons List --}}
                                            <div x-show="open" x-transition class="border-t border-gray-200">
                                                @if ($module->lessons->count() > 0)
                                                    <ul class="divide-y divide-gray-100">
                                                        @foreach ($module->lessons as $lesson)
                                                            <li
                                                                class="px-6 py-4 hover:bg-gray-50 transition flex items-center justify-between group">
                                                                <div class="flex items-center flex-1">
                                                                    {{-- Icon --}}
                                                                    @if ($lesson->video_url)
                                                                        <div
                                                                            class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition">
                                                                            <svg class="w-5 h-5 text-blue-600"
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
                                                                            class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-gray-200 transition">
                                                                            <svg class="w-5 h-5 text-gray-400"
                                                                                fill="none" stroke="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                            </svg>
                                                                        </div>
                                                                    @endif

                                                                    {{-- Title --}}
                                                                    <span
                                                                        class="text-gray-900 font-medium group-hover:text-primary-600 transition">{{ $lesson->title }}</span>
                                                                </div>

                                                                {{-- Completion Badge --}}
                                                                @if ($userEnrollment && $lesson->isCompletedBy(auth()->user()))
                                                                    <div
                                                                        class="flex items-center text-green-600 text-sm font-medium">
                                                                        <svg class="w-5 h-5 mr-1" fill="currentColor"
                                                                            viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd"
                                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                        Selesai
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
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="mt-4 text-gray-600">Belum ada materi yang ditambahkan.</p>
                                </div>
                            @endif
                        </div>

                        {{-- Overview Tab --}}
                        <div x-show="activeTab === 'overview'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Kursus Ini</h2>

                            {{-- FIXED: Strip HTML tags --}}
                            <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                                <p>{{ strip_tags($course->description) }}</p>
                            </div>

                            {{-- What You'll Learn --}}
                            <div class="bg-blue-50 rounded-xl p-6 mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Yang Akan Anda Pelajari
                                </h3>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach ($course->modules as $module)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-gray-700">{{ $module->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Requirements --}}
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Persyaratan</h3>
                                <ul class="space-y-2">
                                    <li class="flex items-start text-gray-700">
                                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Koneksi internet yang stabil
                                    </li>
                                    <li class="flex items-start text-gray-700">
                                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Akun pegawai ITTD YPI Al-Azhar
                                    </li>
                                    <li class="flex items-start text-gray-700">
                                        <svg class="w-5 h-5 text-gray-400 mr-2 mt-0.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Kemauan untuk belajar dan berlatih
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Reviews Tab --}}
                        <div x-show="activeTab === 'reviews'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Review Peserta</h2>

                            @if ($course->reviews->count() > 0)
                                <div class="space-y-6">
                                    @foreach ($course->reviews->take(10) as $review)
                                        <div class="flex items-start pb-6 border-b border-gray-100 last:border-0">
                                            {{-- Avatar --}}
                                            <div
                                                class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>

                                            <div class="ml-4 flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                                    <span
                                                        class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>

                                                {{-- Stars --}}
                                                <div class="flex items-center mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>

                                                @if ($review->review)
                                                    <p class="text-gray-700 leading-relaxed">{{ $review->review }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <p class="mt-4 text-gray-600">Belum ada review untuk kursus ini.</p>
                                </div>
                            @endif
                        </div>

                        {{-- Discussion Tab --}}
                        <div x-show="activeTab === 'discussion'" x-transition x-cloak>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Forum Diskusi</h2>

                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                                <p class="mt-4 text-gray-600 mb-4">Forum diskusi untuk kursus ini.</p>
                                <a href="{{ route('forum.index') }}"
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                    Kunjungi Forum →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <div class="bg-white rounded-xl border border-gray-200 p-6 sticky top-24">
                        @if ($userEnrollment)
                            {{-- Enrolled - Progress Section --}}
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-medium text-gray-600">Progress Pembelajaran</span>
                                    <span
                                        class="text-sm font-bold text-primary-600">{{ number_format($userEnrollment->progress_percentage, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 h-3 rounded-full transition-all shadow-sm"
                                        style="width: {{ $userEnrollment->progress_percentage }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    {{ $userEnrollment->completed_lessons_count }} dari
                                    {{ $course->getTotalLessonsAttribute() }} materi selesai
                                </p>
                            </div>

                            {{-- CTA Buttons --}}
                            @if ($userEnrollment->last_accessed_lesson_id)
                                <a href="{{ route('learn.show', [$course->slug, $userEnrollment->lastAccessedLesson->slug]) }}"
                                    class="flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl mb-3">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Lanjutkan Belajar
                                </a>
                            @else
                                @php $firstLesson = $course->modules->first()?->lessons->first(); @endphp
                                @if ($firstLesson)
                                    <a href="{{ route('learn.show', [$course->slug, $firstLesson->slug]) }}"
                                        class="flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl mb-3">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Mulai Belajar
                                    </a>
                                @endif
                            @endif

                            {{-- Completion Badge --}}
                            @if ($userEnrollment->completed_at)
                                <div
                                    class="flex items-center justify-center px-4 py-3 bg-green-50 border-2 border-green-200 rounded-xl mb-6">
                                    <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-green-800 font-semibold">Kursus Selesai</span>
                                </div>
                            @endif
                        @else
                            {{-- Not Enrolled - Enrollment CTA --}}
                            <div class="text-center mb-6">
                                <div class="text-4xl font-bold text-gray-900 mb-2">GRATIS</div>
                                <p class="text-sm text-gray-600">Khusus Pegawai ITTD</p>
                            </div>

                            <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl mb-4">
                                    Daftar Sekarang
                                </button>
                            </form>

                            <div class="text-center text-xs text-gray-500 mb-6">
                                Dengan mendaftar, Anda akan mendapatkan akses penuh ke semua materi
                            </div>
                        @endif

                        {{-- Course Includes --}}
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="font-bold text-gray-900 mb-4">Kursus Ini Termasuk:</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Akses selamanya
                                </li>
                                
                                <li class="flex items-start text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Forum diskusi dengan instruktur
                                </li>
                                <li class="flex items-start text-sm text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Belajar dengan kecepatan Anda sendiri
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endpush
