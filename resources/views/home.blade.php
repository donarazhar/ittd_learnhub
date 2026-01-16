@extends('layouts.app')

@section('title', 'Beranda - IT Learning Hub')

@section('content')
    <!-- Hero Section - Modern & Clean -->
    <section
        class="relative min-h-[90vh] lg:min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-white via-primary-50/30 to-white">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 bg-hero-pattern opacity-50"></div>

        <!-- Gradient Orbs - Subtle & Professional -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 md:w-[500px] md:h-[500px] bg-primary-200/30 rounded-full blur-3xl animate-float">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 md:w-[500px] md:h-[500px] bg-primary-100/40 rounded-full blur-3xl animate-float-slow">
            </div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left animate-fade-in">
                    <!-- Badge -->
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-100/80 backdrop-blur-sm border border-primary-200/50 text-primary-700 text-sm font-medium mb-6">
                        <span class="flex h-2 w-2 relative">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-600"></span>
                        </span>
                        Platform Pembelajaran ITTD YPI Al-Azhar
                    </div>

                    <!-- Main Heading -->
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold text-dark-800 leading-[1.1] mb-6">
                        Tingkatkan
                        <span class="relative inline-block">
                            <span class="text-gradient">Skill IT</span>
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-primary-300" viewBox="0 0 200 12"
                                preserveAspectRatio="none">
                                <path d="M0,8 Q50,0 100,8 T200,8" fill="none" stroke="currentColor" stroke-width="3"
                                    stroke-linecap="round" />
                            </svg>
                        </span>
                        Anda Bersama Kami
                    </h1>

                    <!-- Subheading -->
                    <p class="text-lg sm:text-xl text-dark-400 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Platform Pembelajaran Internal Pegawai YPI Al Azhar. Akses Seluruh Materi Pembelajaran Dengan Mudah,Kapan Saja & Di Mana Saja.
                    </p>

                    <!-- CTA Buttons -->
                    @auth
                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('courses.index') }}" class="btn-primary text-base py-4 px-8 group">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Mulai Belajar
                            </a>
                            <a href="{{ route('my-courses') }}" class="btn-secondary text-base py-4 px-8 group">
                                Kursus Saya
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary text-base py-4 px-8 group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk untuk Memulai
                        </a>
                    @endauth

                    <!-- Trust Indicators -->
                    <div class="mt-10 flex flex-wrap items-center justify-center lg:justify-start gap-x-8 gap-y-4">
                        <div class="flex items-center gap-2 text-dark-400">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">100% Gratis</span>
                        </div>
                        <div class="flex items-center gap-2 text-dark-400">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Jariyyah Ilmu</span>
                        </div>
                        <div class="flex items-center gap-2 text-dark-400">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100">
                                <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Akses Selamanya</span>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Hero Image -->
                <div class="hidden lg:block relative animate-slide-up">
                    <div class="relative">
                        <!-- Decorative Elements -->
                        <div class="absolute -top-8 -left-8 w-72 h-72 bg-primary-200/50 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-8 -right-8 w-72 h-72 bg-primary-300/30 rounded-full blur-3xl"></div>

                        <!-- Main Image Container -->
                        <div
                            class="relative z-10 rounded-3xl overflow-hidden shadow-soft-lg border border-white/50 bg-white/30 backdrop-blur-sm p-4">
                            <img src="{{ asset('img/bg-heronew.png') }}" alt="Platform Pembelajaran ITTD"
                                class="w-full h-auto rounded-2xl" loading="eager">
                        </div>

                        <!-- Floating Cards -->
                        <div
                            class="absolute -left-6 top-1/4 z-20 p-4 bg-white rounded-2xl shadow-xl border border-gray-100 animate-float hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-dark-400 font-medium">Total Kursus</p>
                                    <p class="text-lg font-bold text-dark-800">50+ Materi</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute -right-6 bottom-1/4 z-20 p-4 bg-white rounded-2xl shadow-xl border border-gray-100 animate-float-slow hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-dark-400 font-small">Tersedia</p>
                                    <p class="text-lg font-bold text-dark-800">Forum Diskusi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden md:flex flex-col items-center gap-2 text-dark-300">
            <span class="text-xs font-medium uppercase tracking-wider">Scroll</span>
            <div class="w-6 h-10 rounded-full border-2 border-dark-200 flex items-start justify-center p-1">
                <div class="w-1.5 h-3 bg-primary-500 rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- Learning Categories Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12 lg:mb-16">
                <span class="badge-primary mb-4">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                    Kategori Pembelajaran
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark-800 mb-4">
                    Jelajahi Berbagai <span class="text-gradient">Bidang IT</span>
                </h2>
                <p class="text-lg text-dark-400 max-w-2xl mx-auto">
                    Pilih kategori yang sesuai dengan minat dan kebutuhan pengembangan skill Anda
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
                <!-- Web Development -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-primary-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-primary-600 transition-colors">
                            Web Dev
                        </h3>
                    </div>
                </a>

                <!-- Mobile Development -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-emerald-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-emerald-600 transition-colors">
                            Mobile App
                        </h3>
                    </div>
                </a>

                <!-- Database -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-violet-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-violet-500 to-violet-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-violet-600 transition-colors">
                            Database
                        </h3>
                    </div>
                </a>

                <!-- Cloud Computing -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-cyan-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-cyan-600 transition-colors">
                            Cloud
                        </h3>
                    </div>
                </a>

                <!-- DevOps -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-orange-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-orange-600 transition-colors">
                            DevOps
                        </h3>
                    </div>
                </a>

                <!-- Cybersecurity -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-rose-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-rose-600 transition-colors">
                            Security
                        </h3>
                    </div>
                </a>

                <!-- Data Science -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-pink-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-pink-600 transition-colors">
                            Data Science
                        </h3>
                    </div>
                </a>

                <!-- UI/UX Design -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-indigo-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-indigo-600 transition-colors">
                            UI/UX
                        </h3>
                    </div>
                </a>

                <!-- AI/ML -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-amber-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-amber-600 transition-colors">
                            AI/ML
                        </h3>
                    </div>
                </a>

                <!-- Network -->
                <a href="{{ route('courses.index') }}" class="group card-hover">
                    <div
                        class="card p-5 sm:p-6 text-center h-full flex flex-col items-center justify-center group-hover:border-teal-300">
                        <div
                            class="w-14 h-14 sm:w-16 sm:h-16 mb-4 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                        </div>
                        <h3
                            class="text-sm sm:text-base font-bold text-dark-700 group-hover:text-teal-600 transition-colors">
                            Network
                        </h3>
                    </div>
                </a>
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('courses.index') }}" class="btn-primary group">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Semua Kursus
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Courses Section -->
    @if ($featuredCourses->count() > 0)
        <section class="py-16 sm:py-20 lg:py-24 bg-gradient-to-b from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-12 lg:mb-16">
                    <span class="badge-primary mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Kursus Terbaru
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-dark-800 mb-4">
                        Mulai <span class="text-gradient">Perjalanan Belajar</span> Anda
                    </h2>
                    <p class="text-lg text-dark-400 max-w-2xl mx-auto">
                        Kursus-kursus pilihan yang dirancang untuk meningkatkan skill IT Anda
                    </p>
                </div>

                <!-- Course Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach ($featuredCourses as $course)
                        <article class="group card overflow-hidden card-hover">
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

                                <!-- Level Badge -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold backdrop-blur-md shadow-sm
                                        {{ $course->level === 'beginner' ? 'bg-emerald-500/90 text-white' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-amber-500/90 text-white' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-rose-500/90 text-white' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>

                                <!-- Overlay on Hover -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-dark-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="p-5 sm:p-6">
                                <!-- Category -->
                                @if ($course->category)
                                    <span class="badge-primary text-xs mb-3">
                                        {{ $course->category->name }}
                                    </span>
                                @endif

                                <!-- Title -->
                                <h3
                                    class="text-lg sm:text-xl font-bold text-dark-800 mb-3 line-clamp-2 leading-tight group-hover:text-primary-600 transition-colors">
                                    {{ $course->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-sm text-dark-400 mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>

                                <!-- Meta Info -->
                                <div
                                    class="flex items-center gap-4 text-sm text-dark-400 mb-5 pb-5 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span>{{ $course->lessons_count ?? 0 }} Lessons</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $course->duration ?? 'N/A' }}</span>
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="btn-ghost w-full py-3 text-primary-600 group/btn">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    @guest
        <section class="relative py-20 sm:py-24 lg:py-32 overflow-hidden">
            <!-- Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800"></div>

            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-hero-pattern"></div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
            </div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
            </div>

            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Icon -->
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-3xl mb-8 border border-white/20">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                    Siap Meningkatkan<br class="hidden sm:block"> Skill IT Anda?
                </h2>

                <!-- Description -->
                <p class="text-lg sm:text-xl text-white/80 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Bergabunglah dengan ratusan pegawai ITTD lainnya yang sudah meningkatkan skill mereka. Mulai perjalanan
                    belajar Anda sekarang!
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-bold rounded-xl hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl touch-manipulation group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk Sekarang
                    </a>

                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white font-bold rounded-xl hover:bg-white/20 hover:border-white/50 transition-all duration-200 touch-manipulation group">
                        Jelajahi Kursus
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="mt-12 flex flex-wrap items-center justify-center gap-6 sm:gap-8">
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium">100% Gratis</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium">Akses Selamanya</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium">Jariyyah Ilmu</span>
                    </div>
                </div>
            </div>
        </section>
    @endguest
@endsection
