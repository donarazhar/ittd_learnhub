@extends('layouts.guest')

@section('title', 'Login - ITTD Learning Hub')

@section('content')
    <div class="min-h-screen flex" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
        <!-- Left Side - Decorative Panel (Hidden on mobile) -->
        <div
            class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
            <!-- Animated Background Pattern -->
            <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>

            <!-- Floating Gradient Orbs -->
            <div class="absolute top-20 left-20 w-72 h-72 bg-primary-400/30 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-primary-300/20 rounded-full blur-3xl animate-float-slow">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-float-delayed">
            </div>

            <!-- Decorative Shapes -->
            <div class="absolute top-10 right-10 w-20 h-20 border-4 border-white/20 rounded-2xl animate-spin-slow"></div>
            <div class="absolute bottom-32 left-16 w-16 h-16 bg-secondary-500/30 rounded-xl rotate-45 animate-float"></div>
            <div class="absolute top-1/3 right-1/4 w-8 h-8 bg-white/20 rounded-full animate-pulse-slow"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                <!-- Logo Animation -->
                <div class="mb-8 opacity-0 animate-bounce-in" :class="loaded ? 'opacity-100' : ''">
                    <div
                        class="w-24 h-24 bg-white/10 backdrop-blur-sm rounded-3xl flex items-center justify-center border border-white/20 shadow-glow-lg">
                        <img src="{{ asset('img/logo-putih.png') }}" alt="IT Learning Hub" class="h-10 w-auto">
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-4xl xl:text-5xl font-bold text-center mb-4 opacity-0 animate-fade-in-up animation-delay-200"
                    :class="loaded ? 'opacity-100' : ''">
                    ITTD Learning Hub
                </h2>

                <p class="text-xl text-primary-100 text-center max-w-md mb-12 opacity-0 animate-fade-in-up animation-delay-300"
                    :class="loaded ? 'opacity-100' : ''">
                    Platform Pembelajaran Internal untuk Pengembangan Skill IT Pegawai YPI Al Azhar
                </p>

                <!-- Features List -->
                <div class="space-y-4 opacity-0 animate-fade-in-up animation-delay-400"
                    :class="loaded ? 'opacity-100' : ''">
                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-white/10">
                        <div class="w-10 h-10 bg-emerald-500/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-white/90">Akses Materi Pembelajaran IT</span>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-white/10">
                        <div class="w-10 h-10 bg-emerald-500/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-white/90">Belajar Digital Untuk Bekal Karir Anda</span>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-white/10">
                        <div class="w-10 h-10 bg-emerald-500/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-white/90">Belajar Kapan Saja, Di Mana Saja</span>
                    </div>
                </div>

                <!-- Bottom Quote -->
                <div class="absolute bottom-8 left-12 right-12 opacity-0 animate-fade-in animation-delay-700"
                    :class="loaded ? 'opacity-100' : ''">
                    <div class="flex items-center gap-3 text-white/60 text-sm">
                        <div class="flex -space-x-2">
                            <div
                                class="w-8 h-8 rounded-full bg-primary-400 flex items-center justify-center text-xs font-bold border-2 border-primary-700">
                                A</div>
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-400 flex items-center justify-center text-xs font-bold border-2 border-primary-700">
                                B</div>
                            <div
                                class="w-8 h-8 rounded-full bg-amber-400 flex items-center justify-center text-xs font-bold border-2 border-primary-700">
                                C</div>
                        </div>
                        <span>Bergabung Dengan 100+ Pegawai Yang Sudah Belajar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div
            class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-8 lg:p-12 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
            <!-- Background Pattern for Mobile -->
            <div class="absolute inset-0 bg-hero-pattern opacity-30 lg:opacity-0"></div>

            <!-- Decorative Elements -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary-100/50 rounded-full blur-3xl lg:hidden"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-primary-50/50 rounded-full blur-3xl lg:hidden"></div>

            <div class="relative w-full max-w-md">
                <!-- Back Button -->
                <div class="mb-8 opacity-0 animate-fade-in-down" :class="loaded ? 'opacity-100' : ''">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center text-sm font-medium text-dark-400 hover:text-primary-600 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>

                <!-- Mobile Logo (Only shown on mobile) -->
                <div class="lg:hidden text-center mb-8 opacity-0 animate-bounce-in animation-delay-100"
                    :class="loaded ? 'opacity-100' : ''">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl mb-4 shadow-glow">
                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-dark-800">ITTD Learning Hub</h1>
                </div>

                <!-- Welcome Text -->
                <div class="text-center lg:text-left mb-8 opacity-0 animate-fade-in-up animation-delay-200"
                    :class="loaded ? 'opacity-100' : ''">
                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-800 mb-2">
                        Selamat Datang! 👋
                    </h2>
                    <p class="text-dark-400">
                        Masuk untuk melanjutkan pembelajaran Anda
                    </p>
                </div>

                <!-- Login Card -->
                <div class="card p-6 sm:p-8 opacity-0 animate-scale-in animation-delay-300"
                    :class="loaded ? 'opacity-100' : ''">
                    <!-- Success/Error Messages -->
                    @if (session('success'))
                        <div
                            class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-start gap-3 animate-fade-in-down">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl flex items-start gap-3 animate-fade-in-down">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl animate-fade-in-down">
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Google SSO Button -->
                    <div class="mb-6">
                        <a href="{{ route('auth.google') }}"
                            class="w-full flex items-center justify-center px-4 py-3.5 bg-white border-2 border-gray-200 rounded-xl 
                                  text-dark-700 font-semibold transition-all duration-200
                                  hover:border-gray-300 hover:bg-gray-50 hover:shadow-soft
                                  focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:ring-offset-2
                                  group touch-manipulation">
                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            Masuk dengan Google
                        </a>
                    </div>

                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-dark-400">atau masuk dengan email</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email / Employee ID -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-dark-700 mb-2">
                                Email atau ID Pegawai
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-dark-300 group-focus-within:text-primary-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="email" type="text" name="email" value="{{ old('email') }}" required
                                    autofocus class="input-field pl-12" placeholder="nama@email.com atau NIP123">
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-dark-700 mb-2">
                                Password
                            </label>
                            <div class="relative group" x-data="{ show: false }">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-dark-300 group-focus-within:text-primary-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                                    class="input-field pl-12 pr-12" placeholder="••••••••">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-dark-400 hover:text-primary-600 transition-colors">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-4 h-4 rounded border-gray-300 text-primary-600 
                                       focus:ring-primary-500 focus:ring-offset-0 transition-colors cursor-pointer">
                            <label for="remember" class="ml-3 text-sm text-dark-500 cursor-pointer select-none">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary w-full py-3.5 text-base group" x-data="{ loading: false }"
                            @click="loading = true" :disabled="loading">
                            <span x-show="!loading" class="flex items-center justify-center">
                                Masuk
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                            <span x-show="loading" x-cloak class="flex items-center justify-center">
                                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center opacity-0 animate-fade-in-up animation-delay-500"
                    :class="loaded ? 'opacity-100' : ''">
                    <p class="text-sm text-dark-400">
                        Belum punya akun?
                        <a href="#" class="font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                            Hubungi admin IT
                        </a>
                        untuk registrasi.
                    </p>
                </div>

                <!-- Security Badge -->
                <div class="mt-6 flex items-center justify-center gap-2 text-xs text-dark-300 opacity-0 animate-fade-in animation-delay-600"
                    :class="loaded ? 'opacity-100' : ''">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Koneksi aman & terenkripsi</span>
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
