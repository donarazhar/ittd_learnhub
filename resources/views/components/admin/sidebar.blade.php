<!-- resources/views/components/admin/sidebar.blade.php -->

<div class="flex h-full flex-col bg-white border-r border-slate-200/80 transition-all duration-300"
    :class="sidebarCollapsed ? 'w-20' : 'w-72'">

    <!-- Logo Section -->
    <div class="flex h-16 shrink-0 items-center justify-between px-4 border-b border-slate-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" x-show="!sidebarCollapsed">
            <img src="{{ asset('img/logo-hitam.png') }}" alt="ITTD Learning Hub" class="h-9 w-auto">
            <span class="text-lg font-bold text-dark-800">Admin<span class="text-primary-500">Panel</span></span>
        </a>

        <!-- Collapsed Logo -->
        <a href="{{ route('admin.dashboard') }}" class="mx-auto" x-show="sidebarCollapsed" x-cloak>
            <div
                class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center">
                <span class="text-white font-bold text-lg">A</span>
            </div>
        </a>

        <!-- Toggle Button (Desktop) -->
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="hidden lg:flex items-center justify-center w-8 h-8 rounded-lg text-dark-400 hover:text-primary-500 hover:bg-primary-50 transition-all"
            :class="sidebarCollapsed ? 'mx-auto' : ''">
            <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 px-3">

        <!-- Dashboard -->
        <div class="mb-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group
                      {{ request()->routeIs('admin.dashboard')
                          ? 'bg-primary-50 text-primary-600 border-l-[3px] border-primary-500'
                          : 'text-dark-600 hover:text-primary-600 hover:bg-slate-50' }}"
                :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                <div
                    class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                            {{ request()->routeIs('admin.dashboard')
                                ? 'bg-primary-500 text-white'
                                : 'bg-slate-100 text-dark-500 group-hover:bg-primary-100 group-hover:text-primary-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Dashboard</span>
            </a>
        </div>

        <!-- Section Label -->
        <div class="mb-2 mt-6 px-3" x-show="!sidebarCollapsed">
            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wider">Manajemen</p>
        </div>
        <div class="mb-2 mt-6 border-t border-slate-200" x-show="sidebarCollapsed" x-cloak></div>

        <!-- Konten -->
        <div class="mb-2" x-data="{ open: {{ request()->routeIs('admin.courses*', 'admin.forum*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-600 hover:text-primary-600 hover:bg-slate-50 transition-all group"
                :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-dark-500 group-hover:bg-primary-100 group-hover:text-primary-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Konten</span>
                </div>
                <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-dark-400 transition-transform duration-200"
                    :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Submenu -->
            <div x-show="open && !sidebarCollapsed" x-collapse
                class="mt-1 ml-6 pl-6 border-l-2 border-slate-100 space-y-1">
                <a href="{{ route('admin.courses.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                          {{ request()->routeIs('admin.courses*')
                              ? 'text-primary-600 font-semibold bg-primary-50'
                              : 'text-dark-500 hover:text-primary-600 hover:bg-slate-50' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ request()->routeIs('admin.courses*') ? 'bg-primary-500' : 'bg-dark-300' }}"></span>
                    <span>Data Kursus</span>
                </a>
                <a href="{{ route('admin.forum.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                          {{ request()->routeIs('admin.forum*')
                              ? 'text-primary-600 font-semibold bg-primary-50'
                              : 'text-dark-500 hover:text-primary-600 hover:bg-slate-50' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ request()->routeIs('admin.forum*') ? 'bg-primary-500' : 'bg-dark-300' }}"></span>
                    <span>Forum & Diskusi</span>
                </a>
            </div>
        </div>

        <!-- Pengguna (Admin Only) -->
        @if (auth()->user()->isAdmin())
            <div class="mb-2" x-data="{ open: {{ request()->routeIs('admin.users*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-600 hover:text-primary-600 hover:bg-slate-50 transition-all group"
                    :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-dark-500 group-hover:bg-primary-100 group-hover:text-primary-600 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Pengguna</span>
                    </div>
                    <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-dark-400 transition-transform duration-200"
                        :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="mt-1 ml-6 pl-6 border-l-2 border-slate-100 space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                              {{ request()->routeIs('admin.users*')
                                  ? 'text-primary-600 font-semibold bg-primary-50'
                                  : 'text-dark-500 hover:text-primary-600 hover:bg-slate-50' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ request()->routeIs('admin.users*') ? 'bg-primary-500' : 'bg-dark-300' }}"></span>
                        <span>Data Pengguna</span>
                    </a>
                </div>
            </div>

            <!-- Section Label: Sistem -->
            <div class="mb-2 mt-6 px-3" x-show="!sidebarCollapsed">
                <p class="text-xs font-semibold text-dark-400 uppercase tracking-wider">Sistem</p>
            </div>
            <div class="mb-2 mt-6 border-t border-slate-200" x-show="sidebarCollapsed" x-cloak></div>

            <!-- Keamanan -->
            <div class="mb-2" x-data="{ open: {{ request()->routeIs('admin.activity-logs*', 'admin.backups*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-600 hover:text-primary-600 hover:bg-slate-50 transition-all group"
                    :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-dark-500 group-hover:bg-primary-100 group-hover:text-primary-600 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Keamanan</span>
                    </div>
                    <svg x-show="!sidebarCollapsed" class="w-4 h-4 text-dark-400 transition-transform duration-200"
                        :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="open && !sidebarCollapsed" x-collapse
                    class="mt-1 ml-6 pl-6 border-l-2 border-slate-100 space-y-1">
                    <a href="{{ route('admin.activity-logs.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                              {{ request()->routeIs('admin.activity-logs*')
                                  ? 'text-primary-600 font-semibold bg-primary-50'
                                  : 'text-dark-500 hover:text-primary-600 hover:bg-slate-50' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ request()->routeIs('admin.activity-logs*') ? 'bg-primary-500' : 'bg-dark-300' }}"></span>
                        <span>Activity Logs</span>
                    </a>
                    <a href="{{ route('admin.backups.index') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all
                              {{ request()->routeIs('admin.backups*')
                                  ? 'text-primary-600 font-semibold bg-primary-50'
                                  : 'text-dark-500 hover:text-primary-600 hover:bg-slate-50' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full flex-shrink-0 {{ request()->routeIs('admin.backups*') ? 'bg-primary-500' : 'bg-dark-300' }}"></span>
                        <span>Backup & Restore</span>
                    </a>
                </div>
            </div>
        @endif
    </nav>

    <!-- Bottom Section -->
    <div class="shrink-0 border-t border-slate-100 p-3">
        <a href="{{ route('home') }}" target="_blank"
            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-dark-600 hover:text-primary-600 hover:bg-slate-50 transition-all group"
            :class="sidebarCollapsed ? 'justify-center px-2' : ''">
            <div
                class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-dark-500 group-hover:bg-primary-100 group-hover:text-primary-600 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" class="whitespace-nowrap">Lihat Website</span>
        </a>
    </div>
</div>
