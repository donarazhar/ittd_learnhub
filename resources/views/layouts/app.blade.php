<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ITTD Learning Hub')</title>

    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
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

            pre,
            code,
            pre *,
            code * {
                background: transparent !important;
                color: #515151 !important;
                font-family: 'Courier New', Courier, monospace !important;
                font-style: italic !important;
                font-size: 0.95em !important;
                padding: 0 !important;
                border: none !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 antialiased">
    @include('components.frontend.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.frontend.footer')

    @stack('scripts')
</body>

</html>
