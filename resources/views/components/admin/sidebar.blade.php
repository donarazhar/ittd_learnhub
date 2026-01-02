<!-- resources/views/components/admin/sidebar.blade.php -->

<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <!-- Logo -->
    <div class="flex h-16 shrink-0 items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <div class="p-2 bg-gradient-primary rounded-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <span class="ml-3 text-xl font-bold text-gray-900">IT Learning</span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.dashboard') 
                                      ? 'bg-primary-50 text-primary-600' 
                                      : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Courses -->
                    <li x-data="{ open: {{ request()->routeIs('admin.courses*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="group flex w-full items-center justify-between gap-x-3 rounded-md p-2 text-sm font-semibold leading-6
                                       {{ request()->routeIs('admin.courses*') 
                                           ? 'bg-primary-50 text-primary-600' 
                                           : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <div class="flex items-center gap-x-3">
                                <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kursus
                            </div>
                            <svg class="h-5 w-5 transition-transform" :class="open ? 'rotate-90' : ''"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="mt-1 px-2 space-y-1" style="display: none;">
                            <li>
                                <a href="{{ route('admin.courses.index') }}"
                                    class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 
                                          {{ request()->routeIs('admin.courses.index') 
                                              ? 'text-primary-600 font-semibold' 
                                              : 'text-gray-700 hover:bg-gray-50' }}">
                                    Semua Kursus
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.courses.create') }}"
                                    class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 
                                          {{ request()->routeIs('admin.courses.create') 
                                              ? 'text-primary-600 font-semibold' 
                                              : 'text-gray-700 hover:bg-gray-50' }}">
                                    Buat Kursus Baru
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Users (Admin Only) -->
                    @if(auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.users*') 
                                      ? 'bg-primary-50 text-primary-600' 
                                      : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Pengguna
                        </a>
                    </li>
                    @endif

                    <!-- Analytics -->
                    <li>
                        <a href="{{ route('admin.analytics.index') }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.analytics*') 
                                      ? 'bg-primary-50 text-primary-600' 
                                      : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Analitik
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Bottom section -->
            <li class="-mx-6 mt-auto">
                <div class="border-t border-gray-200 pt-4 px-6">
                    <a href="{{ route('home') }}"
                        class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50">
                        <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Website
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>