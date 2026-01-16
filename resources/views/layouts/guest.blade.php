<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0053C5">
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
                        'glow-lg': '0 0 40px rgba(0, 83, 197, 0.4)',
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'hero-pattern': 'url("data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%230053C5\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-in': 'fadeIn 0.6s ease-out forwards',
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'fade-in-down': 'fadeInDown 0.6s ease-out forwards',
                        'slide-in-left': 'slideInLeft 0.6s ease-out forwards',
                        'slide-in-right': 'slideInRight 0.6s ease-out forwards',
                        'scale-in': 'scaleIn 0.4s ease-out forwards',
                        'bounce-in': 'bounceIn 0.6s ease-out forwards',
                        'spin-slow': 'spin 8s linear infinite',
                        'gradient-shift': 'gradientShift 8s ease infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px) rotate(0deg)'
                            },
                            '50%': {
                                transform: 'translateY(-20px) rotate(2deg)'
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
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeInDown: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        slideInLeft: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-50px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            },
                        },
                        slideInRight: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(50px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            },
                        },
                        scaleIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            },
                        },
                        bounceIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.3)'
                            },
                            '50%': {
                                transform: 'scale(1.05)'
                            },
                            '70%': {
                                transform: 'scale(0.9)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            },
                        },
                        gradientShift: {
                            '0%, 100%': {
                                backgroundPosition: '0% 50%'
                            },
                            '50%': {
                                backgroundPosition: '100% 50%'
                            },
                        },
                        shimmer: {
                            '0%': {
                                backgroundPosition: '-200% 0'
                            },
                            '100%': {
                                backgroundPosition: '200% 0'
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

            /* Focus Ring */
            .focus-ring {
                @apply focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2;
            }

            /* Animation Delays */
            .animation-delay-100 {
                animation-delay: 100ms;
            }

            .animation-delay-200 {
                animation-delay: 200ms;
            }

            .animation-delay-300 {
                animation-delay: 300ms;
            }

            .animation-delay-400 {
                animation-delay: 400ms;
            }

            .animation-delay-500 {
                animation-delay: 500ms;
            }

            .animation-delay-600 {
                animation-delay: 600ms;
            }

            .animation-delay-700 {
                animation-delay: 700ms;
            }

            /* Shimmer effect */
            .shimmer {
                background: linear-gradient(90deg,
                        rgba(255, 255, 255, 0) 0%,
                        rgba(255, 255, 255, 0.4) 50%,
                        rgba(255, 255, 255, 0) 100%);
                background-size: 200% 100%;
            }
        }

        @layer components {

            /* Primary Button */
            .btn-primary {
                @apply inline-flex items-center justify-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 active:bg-primary-700 transition-all duration-200 ease-out shadow-soft hover:shadow-soft-lg hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 touch-manipulation;
            }

            /* Secondary Button */
            .btn-secondary {
                @apply inline-flex items-center justify-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-xl border-2 border-primary-200 hover:border-primary-500 hover:bg-primary-50 transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-primary-500/50 focus:ring-offset-2 touch-manipulation;
            }

            /* Input Field */
            .input-field {
                @apply block w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-dark-800 placeholder-dark-300 transition-all duration-200 ease-out focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 hover:border-gray-300;
            }

            /* Card */
            .card {
                @apply bg-white rounded-2xl border border-gray-100 shadow-soft transition-all duration-300;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased min-h-screen">
    @yield('content')

    @stack('scripts')
</body>

</html>
