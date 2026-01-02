<!-- resources/views/components/frontend/navbar.blade.php -->

<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Navigation -->
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="p-2 bg-gradient-primary rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="ml-3 text-xl font-bold text-gray-900">IT Learning Hub</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('home') ? 'border-b-2 border-primary-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                        Beranda
                    </a>
                    <a href="{{ route('courses.index') }}" 
                       class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('courses.*') ? 'border-b-2 border-primary-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                        Kursus
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'border-b-2 border-primary-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
                            Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                @auth
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" @click.away="open = false" class="relative">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                            <div class="h-8 w-8 rounded-full bg-gradient-primary flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                             style="display: none;">
                            <div class="py-1">
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'kontributor')
                                    <a href="{{ route('admin.dashboard') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Admin Panel
                                    </a>
                                @endif
                                <a href="{{ route('profile.show') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profil Saya
                                </a>
                                <a href="{{ route('my-courses') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Kursus Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition text-sm">
                        Masuk
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" class="sm:hidden" style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" 
               class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('home') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Beranda
            </a>
            <a href="{{ route('courses.index') }}" 
               class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('courses.*') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Kursus
            </a>
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs('dashboard') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                    Dashboard
                </a>
            @endauth
        </div>
        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center">
                        <span class="text-white font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'kontributor')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100">
                            Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('profile.show') }}" 
                       class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100">
                        Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <a href="{{ route('login') }}" 
                   class="block mx-4 px-4 py-2 bg-gradient-primary text-white font-semibold rounded-lg text-center">
                    Masuk
                </a>
            </div>
        @endauth
    </div>
</nav>