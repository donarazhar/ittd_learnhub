<!-- resources/views/components/admin/navbar.blade.php -->

<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
    <!-- Mobile menu button -->
    <button
        @click="sidebarOpen = true"
        type="button"
        class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Separator -->
    <div class="h-6 w-px bg-gray-200 lg:hidden"></div>

    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <!-- Search -->
        <div class="relative flex flex-1 items-center">
            <span class="text-sm text-gray-500">
                Selamat datang, <span class="font-semibold text-gray-900">{{ auth()->user()->name }}</span>
            </span>
        </div>

        <div class="flex items-center gap-x-4 lg:gap-x-6">
            <!-- Profile dropdown -->
            <div x-data="{ open: false }" @click.away="open = false" class="relative">
                <button
                    @click="open = !open"
                    type="button"
                    class="-m-1.5 flex items-center p-1.5">
                    <span class="sr-only">Open user menu</span>
                    <div class="h-8 w-8 rounded-full bg-gradient-primary flex items-center justify-center text-white font-semibold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <span class="hidden lg:flex lg:items-center">
                        <span class="ml-4 text-sm font-semibold leading-6 text-gray-900">
                            {{ auth()->user()->name }}
                        </span>
                        <svg class="ml-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

                <div x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5"
                    style="display: none;">

                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>

                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>