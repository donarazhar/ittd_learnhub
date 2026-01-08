<!-- resources/views/components/frontend/navbar.blade.php -->

<nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ open: false, profileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('img/logo-hitam.png') }}" alt="IT Learning Hub" class="h-12 w-auto">
                        <span class="ml-3 text-xl font-bold text-dark-700">ITTD Learning Hub</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-primary-500 text-dark-700' : 'border-transparent text-dark-500 hover:border-gray-300 hover:text-dark-700' }} text-sm font-medium">
                        Beranda
                    </a>

                    <a href="{{ route('courses.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('courses.*') ? 'border-primary-500 text-dark-700' : 'border-transparent text-dark-500 hover:border-gray-300 hover:text-dark-700' }} text-sm font-medium">
                        Kursus
                    </a>

                    <a href="{{ route('forum.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('forum.*') ? 'border-primary-500 text-dark-700' : 'border-transparent text-dark-500 hover:border-gray-300 hover:text-dark-700' }} text-sm font-medium">
                        Forum
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') || request()->routeIs('my-courses') ? 'border-primary-500 text-dark-700' : 'border-transparent text-dark-500 hover:border-gray-300 hover:text-dark-700' }} text-sm font-medium">
                            Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                @auth
                    <!-- Admin Button (if admin or kontributor) -->
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'kontributor')
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-600 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Admin Panel
                        </a>
                    @endif

                    <!-- Profile Dropdown -->
                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen"
                            class="flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 rounded-lg">
                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="ml-3 text-dark-700 font-medium">{{ auth()->user()->name }}</span>
                            <svg class="ml-2 h-5 w-5 text-dark-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
                            style="display: none;">
                            <div class="py-1">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm text-dark-500">Signed in as</p>
                                    <p class="text-sm font-medium text-dark-700 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.show') }}"
                                    class="block px-4 py-2 text-sm text-dark-700 hover:bg-gray-100">
                                    <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('my-courses') }}"
                                    class="block px-4 py-2 text-sm text-dark-700 hover:bg-gray-100">
                                    <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Kursus Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login & Register Buttons for Guest -->
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-4 py-2 border border-primary-500 text-sm font-medium rounded-md text-primary-500 bg-white hover:bg-primary-50 transition">
                        Login
                    </a>

                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-dark-400 hover:text-dark-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                    <svg class="h-6 w-6" :class="{ 'hidden': open, 'block': !open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{ 'block': open, 'hidden': !open }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden" x-show="open" x-transition style="display: none;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-dark-600 hover:bg-gray-50 hover:border-gray-300 hover:text-dark-800' }} text-base font-medium">
                Beranda
            </a>
            <a href="{{ route('courses.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('courses.*') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-dark-600 hover:bg-gray-50 hover:border-gray-300 hover:text-dark-800' }} text-base font-medium">
                Kursus
            </a>
            <a href="{{ route('forum.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('forum.*') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-dark-600 hover:bg-gray-50 hover:border-gray-300 hover:text-dark-800' }} text-base font-medium">
                Forum
            </a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') || request()->routeIs('my-courses') ? 'border-primary-500 text-primary-700 bg-primary-50' : 'border-transparent text-dark-600 hover:bg-gray-50 hover:border-gray-300 hover:text-dark-800' }} text-base font-medium">
                    Dashboard
                </a>
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="shrink-0">
                        <div
                            class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-dark-800">{{ auth()->user()->name }}</div>
                        <div class="text-sm font-medium text-dark-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    @if (auth()->user()->role === 'admin' || auth()->user()->role === 'kontributor')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-2 text-base font-medium text-dark-500 hover:text-dark-800 hover:bg-gray-100">
                            Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 text-base font-medium text-dark-500 hover:text-dark-800 hover:bg-gray-100">
                        Profil Saya
                    </a>
                    <a href="{{ route('my-courses') }}"
                        class="block px-4 py-2 text-base font-medium text-dark-500 hover:text-dark-800 hover:bg-gray-100">
                        Kursus Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="space-y-1">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-base font-medium text-primary-500 hover:text-primary-700 hover:bg-gray-100">
                        Login
                    </a>

                </div>
            </div>
        @endauth
    </div>
</nav>
