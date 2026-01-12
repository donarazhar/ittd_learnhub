<!-- resources/views/components/admin/sidebar.blade.php -->

<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
    <!-- Logo -->
    <div class="flex h-24 shrink-0 items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img src="{{ asset('img/logo-hitam.png') }}" alt="IT Learning Hub" class="h-10 w-auto">
            <span class="ml-1 text-xl font-bold text-dark-700">Admin Panel</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                          {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
                    <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Manajemen Konten -->
            <li x-data="{ open: {{ request()->routeIs('admin.courses*', 'admin.forum*') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                    class="w-full group flex items-center justify-between rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:text-primary-600 hover:bg-gray-50">
                    <div class="flex items-center gap-x-3">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Konten</span>
                    </div>
                    <svg class="h-5 w-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-90': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-collapse class="mt-1 space-y-1">
                    <li>
                        <a href="{{ route('admin.courses.index') }}"
                            class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                  {{ request()->routeIs('admin.courses*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <span>Data Kursus</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.forum.index') }}"
                            class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                  {{ request()->routeIs('admin.forum*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <span>Forum & Diskusi</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Manajemen Pengguna (Admin Only) -->
            @if (auth()->user()->isAdmin())
                <li x-data="{ open: {{ request()->routeIs('admin.users*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" type="button"
                        class="w-full group flex items-center justify-between rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:text-primary-600 hover:bg-gray-50">
                        <div class="flex items-center gap-x-3">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Pengguna</span>
                        </div>
                        <svg class="h-5 w-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-90': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-collapse class="mt-1 space-y-1">
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                      {{ request()->routeIs('admin.users*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                                <span>Data Pengguna</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sistem & Keamanan (Admin Only) -->
                <li x-data="{ open: {{ request()->routeIs('admin.activity-logs*', 'admin.backups*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" type="button"
                        class="w-full group flex items-center justify-between rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:text-primary-600 hover:bg-gray-50">
                        <div class="flex items-center gap-x-3">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Sistem</span>
                        </div>
                        <svg class="h-5 w-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-90': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <ul x-show="open" x-collapse class="mt-1 space-y-1">
                        <li>
                            <a href="{{ route('admin.activity-logs.index') }}"
                                class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                      {{ request()->routeIs('admin.activity-logs*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                                <span>Activity Logs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.backups.index') }}"
                                class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                      {{ request()->routeIs('admin.backups*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                                <span>Backup & Restore</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Analitik & Laporan -->
            <li x-data="{ open: {{ request()->routeIs('admin.analytics*') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                    class="w-full group flex items-center justify-between rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:text-primary-600 hover:bg-gray-50">
                    <div class="flex items-center gap-x-3">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Laporan</span>
                    </div>
                    <svg class="h-5 w-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-90': open }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-collapse class="mt-1 space-y-1">
                    <li>
                        <a href="{{ route('admin.analytics.index') }}"
                            class="flex items-center gap-x-3 rounded-md py-2 px-2 pl-11 text-sm leading-6 
                                  {{ request()->routeIs('admin.analytics*') ? 'text-primary-600 font-semibold bg-primary-50' : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <span>Overview</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Bottom section -->
            <li class="mt-auto">
                <div class="border-t border-gray-200 pt-4">
                    <a href="{{ route('home') }}"
                        class="group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:text-primary-600 hover:bg-gray-50">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Website</span>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>
