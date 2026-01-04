<!-- resources/views/courses/show.blade.php -->

@extends('layouts.app')

@section('title', $course->title)

@section('content')
    <!-- Course Header -->
    <div class="bg-gradient-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Course Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="px-3 py-1 bg-white bg-opacity-20 text-white text-xs font-semibold rounded-full">
                            {{ ucfirst($course->level) }}
                        </span>
                        <span class="text-blue-100 text-sm">{{ $course->total_enrolled }} peserta terdaftar</span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $course->title }}</h1>
                    <p class="text-blue-100 mb-6">{{ $course->description }}</p>

                    <div class="flex items-center space-x-6 text-sm text-blue-100">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Dibuat oleh: {{ $course->creator->name }}
                        </div>
                        @if($course->average_rating > 0)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-1 text-secondary-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                {{ number_format($course->average_rating, 1) }} ({{ $course->reviews->count() }} ulasan)
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Thumbnail/CTA -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                        @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-primary-soft flex items-center justify-center">
                                <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6">
                            @auth
                                @if($userEnrollment)
                                    <a href="{{ route('learn.show', [$course->slug, $userEnrollment->lastAccessedLesson ? $userEnrollment->lastAccessedLesson->slug : $course->modules->first()->lessons->first()->slug]) }}" 
                                       class="block w-full text-center px-4 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition mb-3">
                                        Lanjutkan Belajar
                                    </a>
                                    <div class="text-center">
                                        <span class="text-sm text-gray-600">Progress: {{ number_format($userEnrollment->progress_percentage, 0) }}%</span>
                                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $userEnrollment->progress_percentage }}%"></div>
                                        </div>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                        @csrf
                                        <button 
                                            type="submit"
                                            class="block w-full text-center px-4 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                                            Daftar Kursus
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="block w-full text-center px-4 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                                    Masuk untuk Mendaftar
                                </a>
                            @endauth

                            <div class="mt-4 pt-4 border-t border-gray-200 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Total Modul:</span>
                                    <span class="font-semibold">{{ $course->modules->count() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Materi:</span>
                                    <span class="font-semibold">{{ $course->total_lessons }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Tabs -->
                <div class="bg-white rounded-lg shadow" x-data="{ activeTab: 'silabus' }">
                    <div class="border-b border-gray-200">
                        <div class="flex">
                            <button @click="activeTab = 'silabus'" 
                                    :class="activeTab === 'silabus' ? 'border-b-2 border-primary-500 text-primary-600' : 'text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-4 font-medium">
                                Silabus
                            </button>
                            <button @click="activeTab = 'reviews'" 
                                    :class="activeTab === 'reviews' ? 'border-b-2 border-primary-500 text-primary-600' : 'text-gray-500 hover:text-gray-700'"
                                    class="px-6 py-4 font-medium">
                                Ulasan
                            </button>
                        </div>
                    </div>

                    <!-- Silabus Tab -->
                    <div x-show="activeTab === 'silabus'" class="p-6">
                        <div class="space-y-4">
                            @foreach($course->modules as $module)
                                <div class="border border-gray-200 rounded-lg" x-data="{ open: true }">
                                    <button @click="open = !open" 
                                            class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 rounded-t-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="open ? 'rotate-90' : ''" 
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <h3 class="font-semibold text-gray-900">{{ $module->title }}</h3>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $module->lessons->count() }} materi</span>
                                    </button>

                                    <div x-show="open" class="p-4 space-y-2">
                                        @foreach($module->lessons as $lesson)
                                            <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded">
                                                @if($lesson->video_url)
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                @endif
                                                <span class="text-sm text-gray-700">{{ $lesson->title }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Reviews Tab -->
                    <div x-show="activeTab === 'reviews'" class="p-6" style="display: none;">
                        @if($course->reviews->count() > 0)
                            <div class="space-y-6">
                                @foreach($course->reviews as $review)
                                    <div class="border-b border-gray-200 pb-6">
                                        <div class="flex items-start space-x-4">
                                            <div class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center flex-shrink-0">
                                                <span class="text-white font-semibold">
                                                    {{ substr($review->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                                                    <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="flex items-center mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-secondary-500' : 'text-gray-300' }}" 
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                @if($review->review)
                                                    <p class="text-gray-700 text-sm">{{ $review->review }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500">Belum ada ulasan untuk kursus ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar: Instructor Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Tentang Instruktur</h3>
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="h-12 w-12 rounded-full bg-gradient-primary flex items-center justify-center">
                            <span class="text-white font-semibold text-lg">
                                {{ substr($course->creator->name, 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $course->creator->name }}</h4>
                            <span class="text-sm text-gray-500">{{ ucfirst($course->creator->role) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection