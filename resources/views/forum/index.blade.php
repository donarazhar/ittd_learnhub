@extends('layouts.app')

@section('title', 'Forum Diskusi')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="flex-1">
                    <div class="flex items-center mb-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h1 class="text-4xl font-bold">Forum Diskusi</h1>
                    </div>
                    <p class="text-xl text-white/90 max-w-2xl">
                        Ruang kolaborasi untuk bertanya, berbagi pengetahuan, dan berdiskusi dengan rekan pegawai
                    </p>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 bg-white/10 backdrop-blur-sm rounded-xl p-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">{{ $discussions->total() }}</div>
                        <div class="text-sm text-white/80">Diskusi</div>
                    </div>
                    <div class="text-center border-l border-white/20">
                        <div class="text-3xl font-bold mb-1">{{ $totalReplies ?? 0 }}</div>
                        <div class="text-sm text-white/80">Balasan</div>
                    </div>
                    <div class="text-center border-l border-white/20">
                        <div class="text-3xl font-bold mb-1">{{ $activeUsers ?? 0 }}</div>
                        <div class="text-sm text-white/80">Pengguna Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Filter & Search Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter & Pencarian
                        </h2>
                    </div>

                    <div class="p-6">
                        <form method="GET" action="{{ route('forum.index') }}" class="space-y-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari judul diskusi, kata kunci, atau topik..."
                                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                            </div>

                            <!-- Filters Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Course Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kursus</label>
                                    <select name="course_id"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                        <option value="">Semua Kursus</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sort Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                                    <select name="sort"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                            Terbaru
                                        </option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                                            Paling Populer
                                        </option>
                                        <option value="most_replied"
                                            {{ request('sort') == 'most_replied' ? 'selected' : '' }}>
                                            Paling Banyak Balasan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <button type="submit"
                                    class="flex-1 md:flex-none px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-sm hover:shadow-md flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Terapkan Filter
                                </button>

                                @if (request('search') || request('course_id') || request('sort'))
                                    <a href="{{ route('forum.index') }}"
                                        class="flex-1 md:flex-none px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-center flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Reset Filter
                                    </a>
                                @endif
                            </div>

                            <!-- Active Filters Display -->
                            @if (request('search') || request('course_id') || request('sort'))
                                <div class="flex flex-wrap gap-2 pt-2 border-t border-gray-200">
                                    <span class="text-sm font-medium text-gray-600">Filter Aktif:</span>
                                    @if (request('search'))
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-primary-100 text-primary-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                            "{{ request('search') }}"
                                        </span>
                                    @endif
                                    @if (request('course_id'))
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            {{ $courses->firstWhere('id', request('course_id'))->title ?? 'Kursus' }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Discussions List -->
                @if ($discussions->count() > 0)
                    <div class="space-y-4">
                        @foreach ($discussions as $discussion)
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-200 hover:border-primary-300 hover:shadow-lg transition-all duration-300 overflow-hidden group">
                                <div class="p-6">
                                    <!-- Discussion Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-3">
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
                                                    class="text-xl font-bold text-gray-900 hover:text-primary-600 transition group-hover:text-primary-600">
                                                    {{ $discussion->title }}
                                                </a>
                                            </div>

                                            <!-- Author & Meta Info -->
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                                                <!-- Author -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="h-9 w-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-sm mr-2 shadow-sm">
                                                        {{ substr($discussion->user->name, 0, 1) }}
                                                    </div>
                                                    <span
                                                        class="font-medium text-gray-900">{{ $discussion->user->name }}</span>
                                                </div>

                                                <span class="text-gray-400">•</span>

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

                                                <span class="text-gray-400">•</span>

                                                <!-- Replies Count -->
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    <span class="font-medium">{{ $discussion->replies_count }}</span>
                                                    <span class="ml-1">balasan</span>
                                                </div>
                                            </div>

                                            <!-- Course Breadcrumb -->
                                            <div
                                                class="inline-flex items-center bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg px-3 py-2 mb-4">
                                                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                <div class="text-sm">
                                                    <span
                                                        class="font-semibold text-blue-700">{{ $discussion->lesson->module->course->title }}</span>
                                                    <span class="mx-1.5 text-blue-400">›</span>
                                                    <span
                                                        class="text-blue-600">{{ $discussion->lesson->module->title }}</span>
                                                    <span class="mx-1.5 text-blue-400">›</span>
                                                    <span class="text-blue-600">{{ $discussion->lesson->title }}</span>
                                                </div>
                                            </div>

                                            <!-- Content Preview -->
                                            <p class="text-gray-700 leading-relaxed line-clamp-3">
                                                {{ Str::limit(strip_tags($discussion->content), 250) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <!-- Tags/Category (Optional) -->
                                        <div class="flex items-center gap-2">
                                            @if ($discussion->replies_count > 10)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
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
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
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
                                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-sm hover:shadow-md group-hover:bg-primary-700">
                                            <span>Lihat Diskusi</span>
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                        <div class="max-w-md mx-auto">
                            <div
                                class="bg-gray-100 rounded-full p-6 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                                @if (request('search') || request('course_id'))
                                    Tidak Ada Hasil
                                @else
                                    Belum Ada Diskusi
                                @endif
                            </h3>
                            <p class="text-gray-600 mb-6 text-lg">
                                @if (request('search') || request('course_id'))
                                    Tidak ada diskusi yang sesuai dengan filter Anda. Coba ubah kriteria pencarian atau
                                    reset
                                    filter.
                                @else
                                    Jadilah yang pertama untuk memulai diskusi dan berbagi pengetahuan dengan komunitas!
                                @endif
                            </p>
                            @if (request('search') || request('course_id'))
                                <a href="{{ route('forum.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Lihat Semua Diskusi
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Popular Topics Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-5 py-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Topik Populer
                        </h3>
                    </div>
                    <div class="p-5">
                        @if (isset($popularTopics) && $popularTopics->count() > 0)
                            <div class="space-y-3">
                                @foreach ($popularTopics as $index => $topic)
                                    <a href="{{ route('forum.show', $topic) }}"
                                        class="block p-3 rounded-lg hover:bg-gray-50 transition group">
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center font-bold text-sm mr-3">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition line-clamp-2 mb-1">
                                                    {{ $topic->title }}
                                                </h4>
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                    </svg>
                                                    {{ $topic->replies_count }} balasan
                                                </div>
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
                                            <p class="text-gray-900 mb-0.5">
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
                        <div class="bg-amber-200 rounded-lg p-2 mr-3">
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
@endsection
