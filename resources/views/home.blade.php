{{-- resources/views/home.blade.php --}}

@extends('layouts.app')

@section('title', 'Beranda - IT Learning Hub')

@section('content')
    <!-- Modern Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-primary-50">
        {{-- Background Patterns --}}
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left Content --}}
                <div class="text-center lg:text-left">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-medium mb-6">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Platform Pembelajaran #1 ITTD YPI Al-Azhar
                    </div>

                    {{-- Main Heading --}}
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Tingkatkan Skill IT Anda di
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600">
                            Learning Hub
                        </span>
                    </h1>

                    {{-- Subheading --}}
                    <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Platform pembelajaran internal khusus pegawai ITTD. Akses ratusan kursus IT, belajar dari expert,
                        dan kembangkan karir Anda.
                    </p>

                    {{-- CTA Buttons --}}
                    @auth
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('courses.index') }}"
                                class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Mulai Belajar Sekarang
                            </a>
                            <a href="{{ route('my-courses') }}"
                                class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-primary-600 hover:text-primary-600 hover:bg-primary-50 transition">
                                Kursus Saya
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk untuk Memulai
                        </a>
                    @endauth

                    {{-- Trust Indicators --}}
                    <div
                        class="mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Gratis untuk Pegawai
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Sertifikat Digital
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akses Selamanya
                        </div>
                    </div>
                </div>

                {{-- Right Content - Image --}}
                <div class="relative lg:h-[600px] flex items-center justify-center">
                    <div class="relative w-full max-w-lg">
                        {{-- Decorative Elements --}}
                        <div
                            class="absolute top-0 right-0 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                        </div>

                        {{-- Main Image --}}
                        <div class="relative">
                            <img src="{{ asset('img/bg-heronew.png') }}" alt="Platform Pembelajaran"
                                class="relative z-10 w-full h-auto drop-shadow-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Stats Section -->
    <div class="bg-white py-16 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                {{-- Stat 1 --}}
                <div class="text-center group">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl mb-4 group-hover:scale-110 transition transform">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">
                        {{ \App\Models\Course::published()->count() }}
                    </div>
                    <div class="text-sm font-medium text-gray-600">Kursus Tersedia</div>
                </div>

                {{-- Stat 2 --}}
                <div class="text-center group">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl mb-4 group-hover:scale-110 transition transform">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">
                        {{ \App\Models\User::where('role', 'user')->count() }}+
                    </div>
                    <div class="text-sm font-medium text-gray-600">Pegawai Aktif</div>
                </div>

                {{-- Stat 3 --}}
                <div class="text-center group">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl mb-4 group-hover:scale-110 transition transform">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">
                        {{ \App\Models\Lesson::count() }}+
                    </div>
                    <div class="text-sm font-medium text-gray-600">Materi Pembelajaran</div>
                </div>

                {{-- Stat 4 --}}
                <div class="text-center group">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl mb-4 group-hover:scale-110 transition transform">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">
                        {{ \App\Models\Enrollment::whereNotNull('completed_at')->count() }}+
                    </div>
                    <div class="text-sm font-medium text-gray-600">Kursus Selesai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section (NEW) -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih Learning Hub?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Platform pembelajaran yang dirancang khusus untuk meningkatkan skill IT pegawai ITTD
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Video Berkualitas HD</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Materi video tutorial berkualitas tinggi yang mudah dipahami, dilengkapi dengan subtitle dan
                        resource pendukung.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Sertifikat Digital</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan sertifikat digital setelah menyelesaikan kursus yang dapat digunakan untuk pengembangan
                        karir.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Belajar Fleksibel</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Akses materi kapan saja, di mana saja. Belajar sesuai dengan waktu dan kecepatan Anda sendiri.
                    </p>
                </div>

                {{-- Feature 4 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Forum Diskusi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Berinteraksi dengan instruktur dan sesama pegawai melalui forum diskusi untuk mendalami materi.
                    </p>
                </div>

                {{-- Feature 5 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Pantau progress belajar Anda dengan dashboard yang informatif dan sistem tracking yang detail.
                    </p>
                </div>

                {{-- Feature 6 --}}
                <div
                    class="group bg-white p-8 rounded-2xl border border-gray-200 hover:border-primary-300 hover:shadow-xl transition">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Materi Terkini</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Konten pembelajaran selalu diperbarui mengikuti perkembangan teknologi dan best practices terbaru.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Courses (IMPROVED) -->
    @if ($featuredCourses->count() > 0)
        <div class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Kursus Terbaru
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mulai Perjalanan Belajar Anda</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Kursus-kursus pilihan yang dirancang untuk meningkatkan skill IT Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredCourses as $course)
                        <div
                            class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:border-primary-300 transition transform hover:-translate-y-1">
                            {{-- Thumbnail --}}
                            <div class="relative h-48 overflow-hidden">
                                @if ($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-white opacity-50" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Level Badge Overlay --}}
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                                        {{ $course->level === 'beginner' ? 'bg-green-500/90 text-white' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-yellow-500/90 text-white' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-red-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition line-clamp-2">
                                    {{ $course->title }}
                                </h3>

                                {{-- FIXED: Strip HTML tags --}}
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                {{-- Meta Info --}}
                                <div
                                    class="flex items-center justify-between text-sm text-gray-500 mb-6 pb-6 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $course->total_enrolled }} Peserta
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ number_format($course->average_rating, 1) }}
                                    </div>
                                </div>

                                {{-- CTA Button --}}
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="group/btn flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl">
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

                {{-- View All Button --}}
                <div class="text-center mt-12">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center px-8 py-4 border-2 border-primary-600 text-primary-600 font-semibold rounded-xl hover:bg-primary-600 hover:text-white transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Lihat Semua Kursus
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Popular Courses (IMPROVED) -->
    @if ($popularCourses->count() > 0)
        <div class="bg-gradient-to-b from-gray-50 to-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Trending
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kursus Paling Populer</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Kursus favorit yang paling banyak dipilih oleh pegawai ITTD
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($popularCourses as $course)
                        <div
                            class="group bg-white border-2 border-gray-200 rounded-2xl hover:border-primary-300 hover:shadow-xl transition p-6 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $course->level === 'beginner' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $course->level === 'intermediate' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $course->level === 'advanced' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                                <div
                                    class="flex items-center text-sm font-semibold text-gray-900 bg-gray-100 px-3 py-1 rounded-full">
                                    <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $course->total_enrolled }}
                                </div>
                            </div>

                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition line-clamp-2">
                                {{ $course->title }}
                            </h3>

                            {{-- FIXED: Strip HTML tags --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($course->description), 100) }}
                            </p>

                            <a href="{{ route('courses.show', $course->slug) }}"
                                class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 group/link">
                                Lihat Detail
                                <svg class="ml-2 w-4 h-4 group-hover/link:translate-x-1 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- CTA Section (IMPROVED) -->
    @guest
        <div class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-700 py-20 overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl"></div>
            </div>

            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-3xl mb-8">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                    Siap Meningkatkan Skill IT Anda?
                </h2>

                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Bergabunglah dengan ratusan pegawai ITTD lainnya yang sudah meningkatkan skill mereka. Mulai perjalanan
                    belajar Anda sekarang!
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 transition shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk Sekarang
                    </a>

                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white font-bold rounded-xl hover:bg-white/20 transition">
                        Jelajahi Kursus
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div class="mt-12 flex flex-wrap items-center justify-center gap-8 text-white/80">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        100% Gratis
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Akses Selamanya
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Sertifikat Digital
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection

{{-- Custom Animations --}}
@push('styles')
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
