
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Selamat Datang di IT Learning Hub
                </h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Platform pembelajaran internal untuk meningkatkan kompetensi dan skill pegawai IT YPI Al-Azhar
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                        Jelajahi Kursus
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition">
                            Masuk
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    @if ($featuredCourses->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kursus Terbaru</h2>
                <p class="text-gray-600">Mulai belajar dengan kursus terbaru kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($featuredCourses as $course)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        @if ($course->thumbnail && Storage::exists($course->thumbnail))
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <img src="https://placehold.co/600x400/0053C5/ffffff?text=No+Image" alt="{{ $course->title }}"
                                class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="px-2 py-1 bg-primary-100 text-primary-800 text-xs font-semibold rounded">
                                    {{ ucfirst($course->level) }}
                                </span>
                                <span class="text-sm text-gray-500">{{ $course->total_enrolled }} peserta</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <a href="{{ route('courses.show', $course->slug) }}"
                                class="inline-flex items-center text-primary-600 hover:text-primary-800 font-medium text-sm">
                                Lihat Detail
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Popular Courses -->
    @if ($popularCourses->count() > 0)
        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Kursus Populer</h2>
                    <p class="text-gray-600">Kursus yang paling banyak diikuti oleh pegawai</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($popularCourses as $course)
                        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                            @if ($course->thumbnail && Storage::exists($course->thumbnail))
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="w-full h-40 object-cover">
                            @else
                                <img src="https://placehold.co/600x400/0053C5/ffffff?text=No+Image"
                                    alt="{{ $course->title }}" class="w-full h-40 object-cover">
                            @endif
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="px-2 py-1 bg-secondary-100 text-secondary-800 text-xs font-semibold rounded">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                        </svg>
                                        {{ $course->total_enrolled }}
                                    </div>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 80) }}</p>
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                        Lihat Semua Kursus
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gradient-primary rounded-2xl p-12 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Siap Meningkatkan Skill Anda?
            </h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pegawai lainnya yang sudah meningkatkan kompetensi mereka
            </p>
            @guest
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-8 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    Mulai Belajar Sekarang
                </a>
            @else
                <a href="{{ route('courses.index') }}"
                    class="inline-flex items-center px-8 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    Jelajahi Kursus
                </a>
            @endguest
        </div>
    </div>
@endsection
