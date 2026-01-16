<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon"/>
    <title>@yield('title', 'Dashboard') - ITTD Learning Hub Admin</title>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#0053C5',
                            600: '#0047ab',
                            700: '#003d91',
                            800: '#002d6b',
                            900: '#001d45',
                        },
                        dark: {
                            DEFAULT: '#1e293b',
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'soft-lg': '0 10px 40px -10px rgba(0, 0, 0, 0.1)',
                        'inner-soft': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.02)',
                    },
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0053C5;
        }

        /* Smooth transitions */
        * {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        /* Remove transition from specific elements */
        [x-cloak] {
            display: none !important;
        }

        /* Admin layout specific */
        .admin-sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .nav-item-active {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-left: 3px solid #0053C5;
        }

        .nav-item-hover:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        /* Stats card gradient */
        .stats-card-blue {
            background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
        }

        .stats-card-green {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .stats-card-purple {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        }

        .stats-card-orange {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
        }
    </style>

    @stack('styles')
</head>

<body class="h-full bg-slate-50" x-data="{ sidebarOpen: false, sidebarCollapsed: false }">
    <div class="min-h-full">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 lg:hidden" style="display: none;"
            @click="sidebarOpen = false">
            <div class="fixed inset-0 bg-dark-900/60 backdrop-blur-sm"></div>
        </div>

        <!-- Mobile Sidebar -->
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 z-50 w-72 lg:hidden"
            style="display: none;" x-init="$watch('sidebarOpen', value => { if (value) sidebarCollapsed = false })">

            <!-- Close button -->
            <button @click="sidebarOpen = false"
                class="absolute top-4 right-4 p-2 rounded-lg bg-white/80 text-dark-500 hover:text-dark-700 hover:bg-white shadow-soft z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            @include('components.admin.sidebar')
        </div>

        <!-- Desktop Sidebar -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex transition-all duration-300"
            :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'">
            @include('components.admin.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="flex flex-col min-h-screen transition-all duration-300"
            :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-72'">

            <!-- Top Navigation Bar -->
            <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/60">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">

                    <!-- Left: Mobile menu button + Search -->
                    <div class="flex items-center gap-4">
                        <!-- Mobile menu button -->
                        <button @click="sidebarOpen = true"
                            class="lg:hidden p-2 -ml-2 rounded-xl text-dark-500 hover:text-primary-500 hover:bg-primary-50 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <!-- Search Bar -->
                        <div class="hidden sm:flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-dark-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" placeholder="Cari menu, data..."
                                    class="w-64 lg:w-80 pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm text-dark-700 placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Right: Actions -->
                    <div class="flex items-center gap-2 sm:gap-4">

                        <!-- Notifications -->
                        <button
                            class="relative p-2 rounded-xl text-dark-500 hover:text-primary-500 hover:bg-primary-50 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <!-- Notification badge -->
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center gap-3 p-1.5 pr-3 rounded-xl hover:bg-slate-100 transition-all">
                                <div
                                    class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm shadow-soft">
                                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-sm font-semibold text-dark-700">{{ auth()->user()->name ?? 'Admin' }}
                                    </p>
                                    <p class="text-xs text-dark-400">
                                        {{ ucfirst(auth()->user()->role ?? 'Administrator') }}</p>
                                </div>
                                <svg class="hidden sm:block w-4 h-4 text-dark-400 transition-transform"
                                    :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-soft-lg border border-slate-200/60 py-2 z-50"
                                style="display: none;">

                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-sm font-semibold text-dark-800">
                                        {{ auth()->user()->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-dark-400">{{ auth()->user()->email ?? 'admin@example.com' }}
                                    </p>
                                </div>

                                <div class="py-2">
                                    <a href="{{ route('profile.show') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-dark-600 hover:text-primary-600 hover:bg-primary-50 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Profil Saya</span>
                                    </a>
                                    <a href="{{ route('home') }}"
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-dark-600 hover:text-primary-600 hover:bg-primary-50 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        <span>Lihat Website</span>
                                    </a>
                                </div>

                                <div class="border-t border-slate-100 pt-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                <!-- Breadcrumb -->
                @if (isset($breadcrumbs))
                    <div class="bg-white border-b border-slate-200/60">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                            <nav class="flex items-center gap-2 text-sm">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="text-dark-400 hover:text-primary-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </a>
                                @foreach ($breadcrumbs as $breadcrumb)
                                    <svg class="w-4 h-4 text-dark-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    @if (isset($breadcrumb['url']))
                                        <a href="{{ $breadcrumb['url'] }}"
                                            class="text-dark-400 hover:text-primary-500 transition-colors">{{ $breadcrumb['label'] }}</a>
                                    @else
                                        <span class="text-dark-700 font-medium">{{ $breadcrumb['label'] }}</span>
                                    @endif
                                @endforeach
                            </nav>
                        </div>
                    </div>
                @endif

                <!-- Page Header -->
                @if (isset($header))
                    <div class="bg-white border-b border-slate-200/60 shadow-sm">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                            {!! $header !!}
                        </div>
                    </div>
                @endif

                <!-- Main Content -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div x-data="{ show: true }" x-show="show"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2" x-init="setTimeout(() => show = false, 5000)"
                            class="mb-6 flex items-center justify-between gap-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false"
                                class="text-emerald-500 hover:text-emerald-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                            class="mb-6 flex items-center justify-between gap-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="text-red-500 hover:text-red-700 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200/60 py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-dark-400">
                        &copy; {{ date('Y') }} <span class="font-medium text-primary-500">ITTD Learning
                            Hub</span>. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
