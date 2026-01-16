<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0053C5">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon"/>
    <title>@yield('title', 'ITTD Learning Hub')</title>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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
                            600: '#0047ab',
                            700: '#003a8c',
                            800: '#002d6d',
                            900: '#00204e',
                            950: '#001433',
                        },
                        secondary: {
                            50: '#fffdf0',
                            100: '#fffbe0',
                            200: '#fff5b3',
                            300: '#ffef85',
                            400: '#ffe958',
                            500: '#FECE00',
                            600: '#d9af00',
                            700: '#b39000',
                            800: '#8c7100',
                            900: '#665200',
                        },
                        dark: {
                            DEFAULT: '#1a1a2e',
                            50: '#f8f8fa',
                            100: '#e8e8ee',
                            200: '#d1d1dd',
                            300: '#a8a8bd',
                            400: '#7f7f9d',
                            500: '#5c5c7d',
                            600: '#45455d',
                            700: '#2e2e3d',
                            800: '#1a1a2e',
                            900: '#0f0f1a',
                        },
                        accent: {
                            blue: '#0053C5',
                            light: '#e6f0ff',
                            muted: '#6b9bd2',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto',
                            'sans-serif'
                        ],
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 83, 197, 0.08), 0 10px 20px -2px rgba(0, 83, 197, 0.04)',
                        'soft-lg': '0 10px 40px -10px rgba(0, 83, 197, 0.15)',
                        'glow': '0 0 20px rgba(0, 83, 197, 0.3)',
                        'inner-soft': 'inset 0 2px 4px 0 rgba(0, 83, 197, 0.05)',
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'hero-pattern': 'url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%230053C5\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        slideUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        scaleIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.95)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            },
                        },
                    },
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer base {
            html {
                scroll-behavior: smooth;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            body {
                @apply text-dark-800 bg-gray-50;
            }

            ::selection {
                @apply bg-primary-500 text-white;
            }
        }

        @layer utilities {

            /* Custom Scrollbar */
            .scrollbar-thin::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }

            .scrollbar-thin::-webkit-scrollbar-track {
                @apply bg-gray-100 rounded-full;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb {
                @apply bg-primary-400 rounded-full;
            }

            .scrollbar-thin::-webkit-scrollbar-thumb:hover {
                @apply bg-primary-500;
            }

            /* Code Styling */
            pre,
            code,
            pre *,
            code * {
                @apply bg-transparent text-dark-600 font-mono italic;
                font-size: 0.95em !important;
            }

            /* Line Clamp */
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Touch Optimization */
            .touch-manipulation {
                touch-action: manipulation;
                -webkit-tap-highlight-color: transparent;
            }

            /* Glass Effect */
            .glass {
                @apply bg-white/70 backdrop-blur-xl border border-white/20;
            }

            .glass-dark {
                @apply bg-dark-800/70 backdrop-blur-xl border border-white/10;
            }

            /* Gradient Text */
            .text-gradient {
                @apply text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-primary-700;
            }

            /* Card Hover Effects */
            .card-hover {
                @apply transition-all duration-300 ease-out;
            }

            .card-hover:hover {
                @apply -translate-y-1 shadow-soft-lg;
            }

            /* Button Press Effect */
            .btn-press:active {
                @apply scale-[0.98] transition-transform duration-75;
            }

            /* Focus Ring */
            .focus-ring {
                @apply focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2;
            }

            /* Safe Area for Mobile */
            .safe-area-bottom {
                padding-bottom: env(safe-area-inset-bottom);
            }

            .safe-area-top {
                padding-top: env(safe-area-inset-top);
            }
        }

        @layer components {

            /* Primary Button */
            .btn-primary {
                @apply inline-flex items-center justify-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 active:bg-primary-700 transition-all duration-200 ease-out shadow-soft hover:shadow-soft-lg focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed touch-manipulation;
            }

            /* Secondary Button */
            .btn-secondary {
                @apply inline-flex items-center justify-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-xl border-2 border-primary-200 hover:border-primary-500 hover:bg-primary-50 transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 touch-manipulation;
            }

            /* Ghost Button */
            .btn-ghost {
                @apply inline-flex items-center justify-center px-6 py-3 text-primary-600 font-semibold rounded-xl hover:bg-primary-50 transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-primary-500/50 touch-manipulation;
            }

            /* Card */
            .card {
                @apply bg-white rounded-2xl border border-gray-100 shadow-soft transition-all duration-300 hover:shadow-soft-lg hover:border-primary-100;
            }

            /* Badge */
            .badge {
                @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold;
            }

            .badge-primary {
                @apply badge bg-primary-100 text-primary-700;
            }

            .badge-success {
                @apply badge bg-emerald-100 text-emerald-700;
            }

            .badge-warning {
                @apply badge bg-amber-100 text-amber-700;
            }

            .badge-danger {
                @apply badge bg-rose-100 text-rose-700;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased min-h-screen flex flex-col">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 
                                    bg-primary-500 text-white px-4 py-2 rounded-lg z-50">
        Skip to main content
    </a>

    @include('components.frontend.navbar')

    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    @include('components.frontend.footer')

    <!-- Back to Top Button -->
    <button x-data="{ show: false }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4" @scroll.window="show = window.pageYOffset > 500"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-40 p-3 bg-primary-500 text-white rounded-full shadow-lg
                   hover:bg-primary-600 hover:shadow-xl transition-all duration-300
                   focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2
                   safe-area-bottom touch-manipulation"
        aria-label="Back to top">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    @stack('scripts')
</body>

</html>
