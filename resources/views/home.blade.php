@extends('layouts.app')

@section('title', 'Beranda - IT Learning Hub')

@section('content')
    <!-- Modern Hero Section - Mobile Optimized -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-primary-50">
        {{-- Background Patterns - Simplified for mobile --}}
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-64 h-64 md:w-96 md:h-96 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob">
            </div>
            <div
                class="absolute top-0 right-0 w-64 h-64 md:w-96 md:h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                {{-- Left Content --}}
                <div class="text-center lg:text-left">
                    {{-- Badge - Mobile optimized --}}
                    <div
                        class="inline-flex items-center px-3 py-2 rounded-full bg-primary-100 text-primary-700 text-xs sm:text-sm font-medium mb-4 sm:mb-6">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="hidden sm:inline">Platform Pembelajaran #1 ITTD YPI Al-Azhar</span>
                        <span class="sm:hidden">Platform #1 ITTD</span>
                    </div>

                    {{-- Main Heading - Better line height for mobile --}}
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-4 leading-tight">
                        Tingkatkan Skill IT Anda di
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600 block mt-2">
                            Learning Hub
                        </span>
                    </h1>

                    {{-- Subheading - Better readability on mobile --}}
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 mb-6 sm:mb-8 leading-relaxed">
                        Platform pembelajaran internal khusus pegawai ITTD. Akses seluruh materi pembelajaran disiplin ilmu
                        yang ada di bagian ITTD.
                    </p>

                    {{-- CTA Buttons - Stack on mobile, side by side on larger screens --}}
                    @auth
                        <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                            <a href="{{ route('courses.index') }}"
                                class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Mulai Belajar Sekarang
                            </a>
                            <a href="{{ route('my-courses') }}"
                                class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-primary-600 hover:text-primary-600 hover:bg-primary-50 transition active:scale-95 touch-manipulation">
                                Kursus Saya
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk untuk Memulai
                        </a>
                    @endauth

                    {{-- Trust Indicators - Mobile friendly --}}
                    <div
                        class="mt-6 sm:mt-8 flex flex-wrap items-center justify-center lg:justify-start gap-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="hidden sm:inline">100% Gratis</span>
                            <span class="sm:hidden">100% Gratis</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="hidden sm:inline">Jariyyah Ilmu</span>
                            <span class="sm:hidden">Jariyyah Ilmu</span>
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

                {{-- Right Content - Image - Hidden on small mobile, shown on tablet+ --}}
                <div class="hidden md:flex relative h-80 lg:h-[500px] items-center justify-center">
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
                                class="relative z-10 w-full h-auto drop-shadow-2xl" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Categories Section - Mobile First -->
    <div class="bg-white py-12 sm:py-16 lg:py-20 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-primary-100 to-purple-100 text-primary-700 text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                            clip-rule="evenodd" />
                    </svg>
                    Kategori Pembelajaran
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3">Jelajahi Kategori IT & Teknologi
                </h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                    Pilih kategori yang sesuai dengan minat dan kebutuhan pengembangan skill Anda
                </p>
            </div>

            {{-- Categories Grid - 2 columns on mobile, 3 on tablet, 5 on desktop --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6 mb-4 sm:mb-6">
                {{-- Web Development --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border-2 border-blue-200 hover:border-blue-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-blue-600 transition leading-tight">
                        Web Development
                    </h3>
                </a>

                {{-- Mobile Development --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border-2 border-green-200 hover:border-green-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-green-600 transition leading-tight">
                        Mobile App
                    </h3>
                </a>

                {{-- Database --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border-2 border-purple-200 hover:border-purple-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-purple-600 transition leading-tight">
                        Database
                    </h3>
                </a>

                {{-- Cloud Computing --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-2xl border-2 border-cyan-200 hover:border-cyan-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-cyan-600 transition leading-tight">
                        Cloud
                    </h3>
                </a>

                {{-- DevOps --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border-2 border-orange-200 hover:border-orange-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-orange-600 transition leading-tight">
                        DevOps
                    </h3>
                </a>

                {{-- Cybersecurity --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-red-50 to-red-100 rounded-2xl border-2 border-red-200 hover:border-red-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-red-600 transition leading-tight">
                        Security
                    </h3>
                </a>

                {{-- Data Science --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl border-2 border-pink-200 hover:border-pink-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-pink-600 transition leading-tight">
                        Data Science
                    </h3>
                </a>

                {{-- UI/UX Design --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl border-2 border-indigo-200 hover:border-indigo-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-indigo-600 transition leading-tight">
                        UI/UX
                    </h3>
                </a>

                {{-- AI/ML --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl border-2 border-yellow-200 hover:border-yellow-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-yellow-600 transition leading-tight">
                        AI/ML
                    </h3>
                </a>

                {{-- Network --}}
                <a href="{{ route('courses.index') }}"
                    class="group flex flex-col items-center p-5 sm:p-6 bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl border-2 border-teal-200 hover:border-teal-400 hover:shadow-xl transition active:scale-95 touch-manipulation">
                    <div
                        class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-3 sm:mb-4 group-hover:scale-110 transition shadow-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                        </svg>
                    </div>
                    <h3
                        class="text-sm sm:text-base font-bold text-gray-900 text-center group-hover:text-teal-600 transition leading-tight">
                        Network
                    </h3>
                </a>
            </div>

            {{-- View All Button - Full width on mobile --}}
            <div class="text-center mt-8 sm:mt-10">
                <a href="{{ route('courses.index') }}"
                    class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-primary-600 to-purple-600 text-white font-bold rounded-xl hover:from-primary-700 hover:to-purple-700 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Semua Kursus
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Courses - Mobile Optimized -->
    @if ($featuredCourses->count() > 0)
        <div class="bg-white py-12 sm:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-primary-100 text-primary-700 text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Kursus Terbaru
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3">Mulai Perjalanan Belajar Anda
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                        Kursus-kursus pilihan yang dirancang untuk meningkatkan skill IT Anda
                    </p>
                </div>

                {{-- Course Cards - 1 column on mobile, 2 on tablet, 3 on desktop --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($featuredCourses as $course)
                        <div
                            class="group bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-2xl hover:border-primary-300 transition active:scale-98 touch-manipulation">
                            {{-- Thumbnail - Optimized height for mobile --}}
                            <div class="relative h-48 sm:h-52 overflow-hidden">
                                @if ($course->thumbnail)
                                    <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                        loading="lazy">
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

                                {{-- Level Badge --}}
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                                        {{ $course->level === 'beginner' ? 'bg-green-500/90 text-white' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-yellow-500/90 text-white' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-red-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Course Info - Better padding for mobile --}}
                            <div class="p-5 sm:p-6">
                                {{-- Category --}}
                                @if ($course->category)
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-medium text-primary-600 bg-primary-50 rounded-lg mb-3">
                                        {{ $course->category->name }}
                                    </span>
                                @endif

                                {{-- Title - Better line clamp --}}
                                <h3
                                    class="text-lg sm:text-xl font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-primary-600 transition">
                                    {{ $course->title }}
                                </h3>

                                {{-- Description - Better for mobile --}}
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($course->description, 100)) }}
                                </p>

                                {{-- Meta Info - Stack on very small screens --}}
                                <div
                                    class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4 pb-4 border-b border-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span>{{ $course->lessons_count ?? 0 }} Lessons</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $course->duration ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                {{-- CTA Button - Full width on mobile --}}
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="inline-flex items-center justify-center w-full px-6 py-3 text-primary-600 font-semibold hover:text-primary-700 group/link active:scale-95 touch-manipulation">
                                    Lihat Detail
                                    <svg class="ml-2 w-4 h-4 group-hover/link:translate-x-1 transition" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- CTA Section - Mobile Optimized -->
    @guest
        <div
            class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-purple-700 py-12 sm:py-16 lg:py-20 overflow-hidden">
            {{-- Background Pattern - Simplified --}}
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
                    class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-3xl mb-6 sm:mb-8">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 sm:mb-6">
                    Siap Meningkatkan Skill IT Anda?
                </h2>

                <p class="text-base sm:text-lg lg:text-xl text-white/90 mb-8 sm:mb-10 max-w-2xl mx-auto leading-relaxed">
                    Bergabunglah dengan ratusan pegawai ITTD lainnya yang sudah meningkatkan skill mereka. Mulai perjalanan
                    belajar Anda sekarang!
                </p>

                {{-- CTA Buttons - Stack on mobile --}}
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 transition shadow-2xl hover:shadow-3xl active:scale-95 touch-manipulation">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk Sekarang
                    </a>

                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white font-bold rounded-xl hover:bg-white/20 transition active:scale-95 touch-manipulation">
                        Jelajahi Kursus
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Trust Indicators - Mobile friendly --}}
                <div class="mt-8 sm:mt-12 flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-sm text-white/80">
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
                        Jariyyah Ilmu
                    </div>
                </div>
            </div>
        </div>
    @endguest
@endsection

{{-- Custom Animations & Mobile Optimizations --}}
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

        /* Mobile touch optimization */
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

        /* Smooth scroll for mobile */
        html {
            scroll-behavior: smooth;
        }

        /* Better button press feedback */
        button:active,
        a:active {
            opacity: 0.9;
        }

        /* Prevent text selection on buttons for mobile */
        button,
        a {
            -webkit-user-select: none;
            user-select: none;
        }
    </style>
@endpush
