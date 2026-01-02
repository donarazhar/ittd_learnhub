<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'IT Learning Hub')</title>

    <!-- Quicksand Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
                    },
                    fontFamily: {
                        sans: ['Quicksand', 'system-ui', 'sans-serif'],
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
        }
        
        @layer components {
            .bg-gradient-primary {
                background: linear-gradient(135deg, #0053C5 0%, #003378 100%);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50">
    @include('components.frontend.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.frontend.footer')

    @stack('scripts')
</body>

</html>