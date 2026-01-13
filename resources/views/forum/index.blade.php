@extends('layouts.app')

@section('title', 'Forum Diskusi')

@php
    $hideFooter = true; // Hide footer on this page
@endphp

@section('content')
    <!-- Hero Section with Integrated Filter -->
    <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Title -->
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 sm:mb-3">Forum Diskusi</h1>
                <p class="text-base sm:text-lg md:text-xl text-white/90 max-w-2xl mx-auto">
                    Ruang kolaborasi untuk bertanya, berbagi pengetahuan, dan berdiskusi dengan rekan pegawai
                </p>
            </div>

            <!-- Integrated Filter Card -->
            <div
                class="bg-white/90 backdrop-blur-sm rounded-2xl border border-white/20 shadow-2xl p-4 sm:p-6 max-w-5xl mx-auto">
                <form method="GET" action="{{ route('forum.index') }}" class="space-y-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul diskusi, kata kunci, atau topik..."
                            class="w-full pl-12 pr-4 py-3 sm:py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm sm:text-base text-gray-900">
                    </div>

                    <!-- Filters Row - Mobile Optimized -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Course Filter -->
                        <select name="course_id"
                            class="px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm text-gray-900">
                            <option value="">📚 Semua Kursus</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Sort Filter -->
                        <select name="sort"
                            class="px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm text-gray-900">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>🆕 Terbaru</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>🔥 Paling Populer
                            </option>
                            <option value="most_replied" {{ request('sort') == 'most_replied' ? 'selected' : '' }}>💬 Paling
                                Banyak Balasan</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                            class="flex-1 sm:flex-none px-6 py-2.5 sm:py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-lg hover:shadow-xl flex items-center justify-center active:scale-95 touch-manipulation">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="hidden sm:inline">Terapkan Filter</span>
                            <span class="sm:hidden">Cari</span>
                        </button>

                        @if (request('search') || request('course_id') || request('sort'))
                            <a href="{{ route('forum.index') }}"
                                class="flex-1 sm:flex-none px-6 py-2.5 sm:py-3 border-2 border-gray-300 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition flex items-center justify-center active:scale-95 touch-manipulation">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>

                    <!-- Active Filters Display -->
                    @if (request('search') || request('course_id') || request('sort'))
                        <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-gray-200">
                            <span class="text-xs sm:text-sm font-medium text-gray-700">Filter Aktif:</span>

                            @if (request('search'))
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs sm:text-sm bg-primary-100 text-primary-700">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    "{{ Str::limit(request('search'), 25) }}"
                                    <a href="{{ route('forum.index', array_merge(request()->except('search'))) }}"
                                        class="ml-1.5 hover:text-primary-900 font-bold">×</a>
                                </span>
                            @endif

                            @if (request('course_id'))
                                <span
                                    class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs sm:text-sm bg-blue-100 text-blue-700">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    {{ Str::limit($courses->firstWhere('id', request('course_id'))->title ?? 'Kursus', 30) }}
                                    <a href="{{ route('forum.index', array_merge(request()->except('course_id'))) }}"
                                        class="ml-1.5 hover:text-blue-900 font-bold">×</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="bg-gray-50 py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8">
                <!-- Main Content - Discussions List -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Results Info -->
                    @if ($discussions->count() > 0)
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                            <h2 class="text-base sm:text-lg font-semibold text-gray-900 mb-2 sm:mb-0">
                                Menampilkan <span class="text-primary-600">{{ $discussions->count() }}</span> dari <span
                                    class="text-primary-600">{{ $discussions->total() }}</span> diskusi
                            </h2>
                        </div>
                    @endif

                    <!-- Discussions List -->
                    @if ($discussions->count() > 0)
                        <div class="space-y-4">
                            @foreach ($discussions as $discussion)
                                <div
                                    class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300 overflow-hidden group">
                                    <div class="p-5 sm:p-6">
                                        <!-- Discussion Header -->
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-3">
                                                    <!-- Pinned Badge -->
                                                    @if ($discussion->is_pinned)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                                            </svg>
                                                            Dipinkan
                                                        </span>
                                                    @endif

                                                    <!-- Title -->
                                                    <a href="{{ route('forum.show', $discussion) }}"
                                                        class="text-lg sm:text-xl font-bold text-gray-900 hover:text-primary-600 transition group-hover:text-primary-600 line-clamp-2 leading-tight">
                                                        {{ $discussion->title }}
                                                    </a>
                                                </div>

                                                <!-- Author & Meta Info -->
                                                <div
                                                    class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs sm:text-sm text-gray-600 mb-4">
                                                    <!-- Author -->
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-8 w-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-xs mr-2 shadow-sm flex-shrink-0">
                                                            {{ substr($discussion->user->name, 0, 1) }}
                                                        </div>
                                                        <span
                                                            class="font-medium text-gray-900 truncate">{{ $discussion->user->name }}</span>
                                                    </div>

                                                    <span class="text-gray-400 hidden sm:inline">•</span>

                                                    <!-- Time -->
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span>{{ optional($discussion->created_at)->diffForHumans() ?? 'Baru saja' }}</span>
                                                    </div>

                                                    <span class="text-gray-400 hidden sm:inline">•</span>

                                                    <!-- Replies Count -->
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                        </svg>
                                                        <span class="font-medium">{{ $discussion->replies_count }}</span>
                                                        <span class="ml-1 hidden sm:inline">balasan</span>
                                                    </div>
                                                </div>

                                                <!-- Course Breadcrumb - Mobile Optimized -->
                                                <div
                                                    class="inline-flex items-start sm:items-center bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg px-3 py-2 mb-4">
                                                    <svg class="w-4 h-4 mr-2 text-blue-600 flex-shrink-0 mt-0.5 sm:mt-0"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                    </svg>
                                                    <div class="text-xs sm:text-sm">
                                                        <span
                                                            class="font-semibold text-blue-700 line-clamp-1">{{ $discussion->lesson->module->course->title }}</span>
                                                        <span class="mx-1.5 text-blue-400 hidden sm:inline">›</span>
                                                        <span
                                                            class="text-blue-600 hidden sm:inline">{{ $discussion->lesson->module->title }}</span>
                                                        <span class="mx-1.5 text-blue-400 hidden sm:inline">›</span>
                                                        <span
                                                            class="text-blue-600 hidden sm:inline">{{ $discussion->lesson->title }}</span>
                                                    </div>
                                                </div>

                                                <!-- Content Preview -->
                                                <p
                                                    class="text-sm sm:text-base text-gray-700 leading-relaxed line-clamp-2 sm:line-clamp-3">
                                                    {{ Str::limit(strip_tags($discussion->content), 250) }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-4 border-t border-gray-100 gap-3">
                                            <!-- Tags -->
                                            <div class="flex flex-wrap items-center gap-2">
                                                @if ($discussion->replies_count > 10)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Populer
                                                    </span>
                                                @endif
                                                @if ($discussion->created_at->isToday())
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Baru
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- View Button -->
                                            <a href="{{ route('forum.show', $discussion) }}"
                                                class="inline-flex items-center justify-center px-5 py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-sm hover:shadow-md group-hover:bg-primary-700 active:scale-95 touch-manipulation">
                                                <span>Lihat Diskusi</span>
                                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($discussions->hasPages())
                            <div class="mt-8">
                                {{ $discussions->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="bg-white rounded-2xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-gray-100 rounded-full mb-4 sm:mb-6">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>

                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">Tidak Ada Diskusi
                                Ditemukan</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-6 max-w-md mx-auto">
                                @if (request('search') || request('course_id') || request('sort'))
                                    Tidak ditemukan diskusi sesuai filter Anda. Coba ubah filter atau kata kunci pencarian.
                                @else
                                    Belum ada diskusi yang tersedia saat ini.
                                @endif
                            </p>

                            @if (request('search') || request('course_id') || request('sort'))
                                <a href="{{ route('forum.index') }}"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg hover:shadow-xl active:scale-95 touch-manipulation">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset & Lihat Semua
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Popular Topics Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-600 to-red-700 px-5 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Topik Populer
                            </h3>
                        </div>
                        <div class="p-5">
                            @if (isset($popularTopics) && $popularTopics->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($popularTopics as $topic)
                                        <a href="{{ route('forum.show', $topic) }}"
                                            class="block p-3 rounded-lg hover:bg-gray-50 transition group">
                                            <h4
                                                class="font-semibold text-gray-900 group-hover:text-primary-600 mb-2 line-clamp-2 text-sm">
                                                {{ $topic->title }}
                                            </h4>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{ $topic->views_count ?? 0 }}
                                                </div>
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    {{ $topic->replies_count }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 text-center py-4">Belum ada topik populer</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-5 py-4">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Aktivitas Terkini
                            </h3>
                        </div>
                        <div class="p-5">
                            @if (isset($recentActivities) && $recentActivities->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($recentActivities as $activity)
                                        <div class="flex items-start text-sm">
                                            <div
                                                class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-semibold text-xs mr-3 flex-shrink-0">
                                                {{ substr($activity->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-gray-900 mb-0.5 line-clamp-1">
                                                    <span class="font-semibold">{{ $activity->user->name }}</span>
                                                    membalas di
                                                </p>
                                                <a href="{{ route('forum.show', $activity->discussion) }}"
                                                    class="text-primary-600 hover:text-primary-700 font-medium line-clamp-1">
                                                    {{ $activity->discussion->title }}
                                                </a>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ optional($activity->created_at)->diffForHumans() ?? 'Baru saja' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas terkini</p>
                            @endif
                        </div>
                    </div>

                    <!-- Guidelines Card -->
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl border border-amber-200 p-5">
                        <div class="flex items-start mb-3">
                            <div class="bg-amber-200 rounded-lg p-2 mr-3 flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-amber-900 mb-2">Panduan Forum</h4>
                                <ul class="space-y-1.5 text-sm text-amber-800">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Gunakan judul yang jelas
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Bersikap sopan dan hormat
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Hindari spam
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Berbagi pengetahuan
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Touch optimization */
        .touch-manipulation {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }

        .active\:scale-95:active {
            transform: scale(0.95);
        }
    </style>
@endpush
