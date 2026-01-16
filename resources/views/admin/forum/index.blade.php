{{-- resources/views/admin/forum/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Forum & Diskusi')

@section('content')
    <!-- Breadcrumb Section -->
    <div class="mb-6">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-[#0053C5] transition">
                Dashboard
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">Forum & Diskusi</span>
        </nav>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Forum & Diskusi
                </h1>
                <p class="mt-2 text-sm text-gray-600">Kelola diskusi dan pertanyaan dari pegawai</p>
            </div>

            <!-- Stats Badge -->
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-br from-[#0053C5] to-[#003d91] text-white px-6 py-3 rounded-xl shadow-lg">
                    <div class="text-2xl font-bold">{{ $discussions->total() }}</div>
                    <div class="text-xs opacity-90">Total Diskusi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 mb-6">
        <div class="flex items-center mb-4">
            <svg class="w-5 h-5 text-[#0053C5] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900">Filter & Pencarian</h3>
        </div>

        <form method="GET" action="{{ route('admin.forum.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Diskusi</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan judul atau konten..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition">
                    </div>
                </div>

                <!-- Course Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kursus</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <select name="course_id"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition appearance-none bg-white">
                            <option value="">Semua Kursus</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Pinned Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pin</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <select name="pinned"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="yes" {{ request('pinned') === 'yes' ? 'selected' : '' }}>Di-pin</option>
                            <option value="no" {{ request('pinned') === 'no' ? 'selected' : '' }}>Tidak Di-pin</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-[#0053C5] hover:bg-[#003d91] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105 group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Terapkan Filter
                </button>

                @if (request('search') || request('course_id') || request('pinned'))
                    <a href="{{ route('admin.forum.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-100 hover:border-gray-400 transition-all group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Discussions List -->
    @if ($discussions->count() > 0)
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
            <div class="divide-y divide-gray-100">
                @foreach ($discussions as $discussion)
                    <div class="p-6 hover:bg-gray-50 transition-all group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <!-- Discussion Header -->
                                <div class="flex items-center mb-3">
                                    @if ($discussion->is_pinned)
                                        <div
                                            class="flex items-center bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full mr-3">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span class="text-xs font-semibold">Dipasang</span>
                                        </div>
                                    @endif
                                    <a href="{{ route('admin.forum.show', $discussion) }}"
                                        class="text-lg font-bold text-gray-900 hover:text-[#0053C5] transition truncate group-hover:underline">
                                        {{ $discussion->title }}
                                    </a>
                                </div>

                                <!-- Discussion Meta -->
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600 mb-3">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center text-white font-semibold text-sm mr-2">
                                            {{ substr($discussion->user->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium">{{ $discussion->user->name }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center text-[#0053C5] font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span>{{ $discussion->replies_count }} balasan</span>
                                    </div>
                                </div>

                                <!-- Course & Lesson Info -->
                                <div class="flex items-center flex-wrap gap-2 text-sm mb-3">
                                    <div class="inline-flex items-center bg-blue-50 text-[#0053C5] px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span
                                            class="font-medium text-xs">{{ $discussion->lesson->module->course->title }}</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span class="text-gray-600 text-xs">{{ $discussion->lesson->module->title }}</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span class="text-gray-600 text-xs">{{ $discussion->lesson->title }}</span>
                                </div>

                                <!-- Content Preview -->
                                <p class="text-gray-700 text-sm line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($discussion->content), 200) }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col space-y-2 ml-4 flex-shrink-0">
                                <form method="POST" action="{{ route('admin.forum.toggle-pin', $discussion) }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-sm px-4 py-2 rounded-lg font-medium transition-all {{ $discussion->is_pinned ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                        <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ $discussion->is_pinned ? 'Unpin' : 'Pin' }}
                                    </button>
                                </form>

                                <a href="{{ route('admin.forum.show', $discussion) }}"
                                    class="text-sm px-4 py-2 bg-blue-100 text-[#0053C5] hover:bg-blue-200 rounded-lg font-medium transition-all text-center">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>

                                <form method="POST" action="{{ route('admin.forum.destroy', $discussion) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-sm px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg font-medium transition-all">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($discussions->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $discussions->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ada diskusi ditemukan</h3>
                <p class="text-gray-600 mb-6">
                    @if (request('search') || request('course_id') || request('pinned'))
                        Coba ubah filter atau kata kunci pencarian Anda
                    @else
                        Belum ada diskusi yang dibuat oleh pegawai
                    @endif
                </p>
                @if (request('search') || request('course_id') || request('pinned'))
                    <a href="{{ route('admin.forum.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-[#0053C5] hover:bg-[#003d91] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Lihat Semua Diskusi
                    </a>
                @endif
            </div>
        </div>
    @endif
@endsection
