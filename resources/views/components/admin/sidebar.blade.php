<!-- resources/views/components/admin/sidebar.blade.php -->

<div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6">
    <!-- Logo -->
    <div class="flex h-24 shrink-0 items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img src="{{ asset('img/logo-hitam.png') }}" alt="IT Learning Hub" class="h-10 w-auto">
            <span class="ml-1 text-xl font-bold text-dark-700">Admin Panel</span>
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
                                  {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Courses (Direct Link) -->
                    <li>
                        <a href="{{ route('admin.courses.index') }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.courses*') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Kursus
                        </a>
                    </li>

                    <!-- Forum & Diskusi -->
                    <li>
                        <a href="{{ route('admin.forum.index') }}"
                            class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.forum*') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Forum & Diskusi
                        </a>
                    </li>

                    <!-- Users (Admin Only) -->
                    @if (auth()->user()->isAdmin())
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 
                                  {{ request()->routeIs('admin.users*') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
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
                                  {{ request()->routeIs('admin.analytics*') ? 'bg-primary-50 text-primary-600' : 'text-dark-700 hover:text-primary-600 hover:bg-gray-50' }}">
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
                        class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-dark-700 hover:bg-gray-50">
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
