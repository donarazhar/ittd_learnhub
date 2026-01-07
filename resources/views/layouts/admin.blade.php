<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - ITTD Learning Hub Admin</title>

    <!-- Inter Font (lebih standar dan nyaman dibaca) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#e6f0ff',
                            100: '#cce0ff',
                            200: '#99c2ff',
                            300: '#66a3ff',
                            400: '#3385ff',
                            500: '#0053C5',
                            600: '#0043a0',
                            700: '#003378',
                            800: '#002250',
                            900: '#001128',
                        },
                        secondary: {
                            50: '#fffbeb',
                            100: '#fff6d6',
                            200: '#ffedad',
                            300: '#fee485',
                            400: '#fedb5c',
                            500: '#FECE00',
                            600: '#cba500',
                            700: '#987c00',
                            800: '#655200',
                            900: '#332900',
                        },
                        dark: {
                            DEFAULT: '#3d3d3d',
                            50: '#f7f7f7',
                            100: '#e3e3e3',
                            200: '#c8c8c8',
                            300: '#a4a4a4',
                            400: '#818181',
                            500: '#666666',
                            600: '#515151',
                            700: '#3d3d3d',
                            800: '#2a2a2a',
                            900: '#1a1a1a',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto',
                            'sans-serif'
                        ],
                    },
                }
            }
        }
    </script>

    <!-- Custom Styles -->
    <style type="text/tailwindcss">
        @layer utilities {
            .scrollbar-thin::-webkit-scrollbar {
                width: 6px;
            }

            .scrollbar-thin::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb {
                background: #0053C5;
                border-radius: 3px;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb:hover {
                background: #003378;
            }
        }

        @layer components {
            .bg-gradient-primary {
                background: linear-gradient(135deg, #0053C5 0%, #003378 100%);
            }

            .bg-gradient-primary-soft {
                background: linear-gradient(135deg, #e6f0ff 0%, #cce0ff 100%);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="h-full" x-data="{ sidebarOpen: false }">
    <div class="min-h-full">
        <!-- Sidebar for mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 flex lg:hidden" style="display: none;">

            <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

            <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="relative flex w-full max-w-xs flex-1 flex-col bg-white">

                @include('components.admin.sidebar')
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
            @include('components.admin.sidebar')
        </div>

        <!-- Main content area -->
        <div class="lg:pl-64 flex flex-col flex-1">
            <!-- Top navbar -->
            @include('components.admin.navbar')

            <!-- Page content -->
            <main class="flex-1">
                <!-- Breadcrumb -->
                @if (isset($breadcrumbs))
                    @include('components.admin.breadcrumb', ['items' => $breadcrumbs])
                @endif

                <!-- Page header -->
                @if (isset($header))
                    <div class="bg-white shadow">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                            {!! $header !!}
                        </div>
                    </div>
                @endif

                <!-- Main content -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Flash messages -->
                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between"
                            x-data="{ show: true }" x-show="show" x-transition style="display: none;">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="text-green-700 hover:text-green-900">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between"
                            x-data="{ show: true }" x-show="show" x-transition style="display: none;">
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="text-red-700 hover:text-red-900">
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
        </div>
    </div>

    @stack('scripts')
</body>

</html>
