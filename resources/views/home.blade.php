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

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                {{-- Left Content --}}
                <div class="text-center lg:text-left">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-primary-100 text-primary-700 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="hidden sm:inline">Platform Pembelajaran #1 ITTD YPI Al-Azhar</span>
                        <span class="sm:hidden">Platform #1 ITTD</span>
                    </div>

                    {{-- Main Heading --}}
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-4 sm:mb-6 leading-tight">
                        Tingkatkan Skill IT Anda di
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600">
                            Learning Hub
                        </span>
                    </h1>

                    {{-- Subheading --}}
                    <p
                        class="text-base sm:text-lg md:text-xl text-gray-600 mb-6 sm:mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Platform pembelajaran internal khusus pegawai ITTD. Akses seluruh materi pembelajaran disiplin ilmu yang ada di bagian ITTD.
                    </p>

                    {{-- CTA Buttons --}}
                    @auth
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                            <a href="{{ route('courses.index') }}"
                                class="group inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm sm:text-base font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Mulai Belajar Sekarang
                            </a>
                            <a href="{{ route('my-courses') }}"
                                class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-gray-300 text-gray-700 text-sm sm:text-base font-semibold rounded-xl hover:border-primary-600 hover:text-primary-600 hover:bg-primary-50 transition">
                                Kursus Saya
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm sm:text-base font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk untuk Memulai
                        </a>
                    @endauth

                    {{-- Trust Indicators --}}
                    <div
                        class="mt-6 sm:mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 text-xs sm:text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mr-1.5 sm:mr-2" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Gratis untuk Pegawai
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mr-1.5 sm:mr-2" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Share Ilmu & Pengalaman
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-500 mr-1.5 sm:mr-2" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akses Selamanya
                        </div>
                    </div>
                </div>

                {{-- Right Content - Image --}}
                <div class="relative h-64 sm:h-80 lg:h-[500px] flex items-center justify-center mt-8 lg:mt-0">
                    <div class="relative w-full max-w-lg">
                        {{-- Decorative Elements --}}
                        <div
                            class="absolute top-0 right-0 w-48 h-48 sm:w-72 sm:h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 sm:w-72 sm:h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
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

    <!-- Learning Categories Section -->
    <div class="bg-white py-12 sm:py-16 lg:py-20 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <div
                    class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-gradient-to-r from-primary-100 to-purple-100 text-primary-700 text-xs sm:text-sm font-medium mb-3 sm:mb-4">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    Kategori Pembelajaran
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">Jelajahi Kategori IT &
                    Teknologi</h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Pilih kategori yang sesuai dengan minat dan kebutuhan pengembangan skill Anda
                </p>
            </div>

            {{-- Row 1 --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 sm:gap-4 md:gap-6 mb-3 sm:mb-4 md:mb-6">
                {{-- Web Development --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl sm:rounded-2xl border-2 border-blue-200 hover:border-blue-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-blue-600 transition">
                        Web Development
                    </h3>
                </a>

                {{-- Mobile Development --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl sm:rounded-2xl border-2 border-green-200 hover:border-green-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-green-600 transition">
                        Mobile Development
                    </h3>
                </a>

                {{-- Database --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl sm:rounded-2xl border-2 border-purple-200 hover:border-purple-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-purple-600 transition">
                        Database
                    </h3>
                </a>

                {{-- Cloud Computing --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-xl sm:rounded-2xl border-2 border-cyan-200 hover:border-cyan-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-cyan-600 transition">
                        Cloud Computing
                    </h3>
                </a>

                {{-- DevOps --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl sm:rounded-2xl border-2 border-orange-200 hover:border-orange-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-orange-600 transition">
                        DevOps
                    </h3>
                </a>
            </div>

            {{-- Row 2 --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 sm:gap-4 md:gap-6">
                {{-- Data Science --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-pink-50 to-pink-100 rounded-xl sm:rounded-2xl border-2 border-pink-200 hover:border-pink-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-pink-600 transition">
                        Data Science
                    </h3>
                </a>

                {{-- Cybersecurity --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-red-50 to-red-100 rounded-xl sm:rounded-2xl border-2 border-red-200 hover:border-red-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-red-600 transition">
                        Cybersecurity
                    </h3>
                </a>

                {{-- UI/UX Design --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl sm:rounded-2xl border-2 border-indigo-200 hover:border-indigo-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-indigo-600 transition">
                        UI/UX Design
                    </h3>
                </a>

                {{-- Artificial Intelligence --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl sm:rounded-2xl border-2 border-yellow-200 hover:border-yellow-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-yellow-600 transition">
                        Artificial Intelligence
                    </h3>
                </a>

                {{-- Network & System --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-4 sm:p-6 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl sm:rounded-2xl border-2 border-teal-200 hover:border-teal-400 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                        </svg>
                    </div>
                    <h3
                        class="text-xs sm:text-sm md:text-base font-bold text-gray-900 text-center group-hover:text-teal-600 transition">
                        Network & System
                    </h3>
                </a>
            </div>
            {{-- View All Categories Button --}}
            <div class="text-center mt-8 sm:mt-10 lg:mt-12">
                <a href="{{ route('courses.index') }}"
                    class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-purple-600 text-white text-sm sm:text-base font-bold rounded-xl hover:from-primary-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Semua Kursus
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    @if ($featuredCourses->count() > 0)
        <div class="bg-white py-12 sm:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                    <div
                        class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-primary-100 text-primary-700 text-xs sm:text-sm font-medium mb-3 sm:mb-4">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Kursus Terbaru
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">Mulai Perjalanan
                        Belajar Anda</h2>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                        Kursus-kursus pilihan yang dirancang untuk meningkatkan skill IT Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach ($featuredCourses as $course)
                        <div
                            class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:border-primary-300 transition transform hover:-translate-y-1">
                            {{-- Thumbnail --}}
                            <div class="relative h-40 sm:h-48 overflow-hidden">
                                @if ($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary-400 via-primary-500 to-primary-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 sm:w-20 sm:h-20 text-white opacity-50" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif

                                {{-- Level Badge Overlay --}}
                                <div class="absolute top-3 sm:top-4 left-3 sm:left-4">
                                    <span
                                        class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                                    {{ $course->level === 'beginner' ? 'bg-green-500/90 text-white' : '' }}
                                    {{ $course->level === 'intermediate' ? 'bg-yellow-500/90 text-white' : '' }}
                                    {{ $course->level === 'advanced' ? 'bg-red-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-4 sm:p-6">
                                <h3
                                    class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-primary-600 transition line-clamp-2">
                                    {{ $course->title }}
                                </h3>

                                <p class="text-gray-600 text-sm mb-3 sm:mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                {{-- Meta Info --}}
                                <div
                                    class="flex items-center justify-between text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6 pb-4 sm:pb-6 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $course->total_enrolled }} Peserta
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ number_format($course->average_rating, 1) }}
                                    </div>
                                </div>

                                {{-- CTA Button --}}
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="group/btn flex items-center justify-center w-full px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm sm:text-base font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl">
                                    Lihat Detail
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover/btn:translate-x-1 transition"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- View All Button --}}
                <div class="text-center mt-8 sm:mt-10 lg:mt-12">
                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 border-2 border-primary-600 text-primary-600 text-sm sm:text-base font-semibold rounded-xl hover:bg-primary-600 hover:text-white transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Lihat Semua Kursus
                        <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Popular Courses -->
    @if ($popularCourses->count() > 0)
        <div class="bg-gradient-to-b from-gray-50 to-white py-12 sm:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                    <div
                        class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 rounded-full bg-yellow-100 text-yellow-700 text-xs sm:text-sm font-medium mb-3 sm:mb-4">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Trending
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">Kursus Paling Populer
                    </h2>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                        Kursus favorit yang paling banyak dipilih oleh pegawai ITTD
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    @foreach ($popularCourses as $course)
                        <div
                            class="group bg-white border-2 border-gray-200 rounded-2xl hover:border-primary-300 hover:shadow-xl transition p-4 sm:p-6 transform hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <span
                                    class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-semibold
                                {{ $course->level === 'beginner' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $course->level === 'intermediate' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $course->level === 'advanced' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($course->level) }}
                                </span>
                                <div
                                    class="flex items-center text-xs sm:text-sm font-semibold text-gray-900 bg-gray-100 px-2 sm:px-3 py-1 rounded-full">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 text-primary-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    {{ $course->total_enrolled }}
                                </div>
                            </div>

                            <h3
                                class="text-base sm:text-lg font-bold text-gray-900 mb-2 sm:mb-3 group-hover:text-primary-600 transition line-clamp-2">
                                {{ $course->title }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-3 sm:mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($course->description), 100) }}
                            </p>

                            <a href="{{ route('courses.show', $course->slug) }}"
                                class="inline-flex items-center text-sm sm:text-base text-primary-600 font-semibold hover:text-primary-700 group/link">
                                Lihat Detail
                                <svg class="ml-2 w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover/link:translate-x-1 transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <!-- CTA Section -->
    @guest
        <div
            class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-700 py-12 sm:py-16 lg:py-20 overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div
                    class="absolute top-0 left-0 w-64 h-64 sm:w-96 sm:h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-64 h-64 sm:w-96 sm:h-96 bg-white rounded-full mix-blend-overlay filter blur-3xl">
                </div>
            </div>

            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-2xl sm:rounded-3xl mb-6 sm:mb-8">
                    <svg class="w-8 h-8 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 px-4">
                    Siap Meningkatkan Skill IT Anda?
                </h2>

                <p class="text-base sm:text-lg lg:text-xl text-white/90 mb-8 sm:mb-10 max-w-2xl mx-auto leading-relaxed px-4">
                    Bergabunglah dengan ratusan pegawai ITTD lainnya yang sudah meningkatkan skill mereka. Mulai perjalanan
                    belajar Anda sekarang!
                </p>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center px-4">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-primary-600 text-sm sm:text-base font-bold rounded-xl hover:bg-gray-100 transition shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk Sekarang
                    </a>

                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white text-sm sm:text-base font-bold rounded-xl hover:bg-white/20 transition">
                        Jelajahi Kursus
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Trust Indicators --}}
                <div
                    class="mt-8 sm:mt-12 flex flex-wrap items-center justify-center gap-4 sm:gap-6 lg:gap-8 text-xs sm:text-sm text-white/80 px-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        100% Gratis
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Akses Selamanya
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
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
