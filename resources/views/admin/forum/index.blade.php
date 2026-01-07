{{-- resources/views/admin/forum/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Forum & Diskusi')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Forum & Diskusi</h1>
        <p class="mt-1 text-sm text-gray-600">Kelola diskusi dan pertanyaan dari pegawai</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <form method="GET" action="{{ route('admin.forum.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari diskusi..."
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            </div>

            <!-- Course Filter -->
            <div class="w-full md:w-64">
                <select name="course_id"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Kursus</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Pinned Filter -->
            <div class="w-full md:w-48">
                <select name="pinned"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="yes" {{ request('pinned') === 'yes' ? 'selected' : '' }}>Di-pin</option>
                    <option value="no" {{ request('pinned') === 'no' ? 'selected' : '' }}>Tidak Di-pin</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="px-6 py-2.5 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>

            @if (request('search') || request('course_id') || request('pinned'))
                <a href="{{ route('admin.forum.index') }}"
                    class="px-6 py-2.5 border border-gray-300 text-dark-600 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Discussions List -->
    @if ($discussions->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="divide-y divide-gray-200">
                @foreach ($discussions as $discussion)
                    <div class="p-6 hover:bg-gray-50 transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <!-- Discussion Header -->
                                <div class="flex items-center mb-2">
                                    @if ($discussion->is_pinned)
                                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                    <a href="{{ route('admin.forum.show', $discussion) }}"
                                        class="text-lg font-semibold text-gray-900 hover:text-primary-600">
                                        {{ $discussion->title }}
                                    </a>
                                </div>

                                <!-- Discussion Meta -->
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <div class="flex items-center mr-4">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                                            {{ substr($discussion->user->name, 0, 1) }}
                                        </div>
                                        <span>{{ $discussion->user->name }}</span>
                                    </div>
                                    <span class="mr-4">•</span>
                                    <span class="mr-4">{{ $discussion->created_at->diffForHumans() }}</span>
                                    <span class="mr-4">•</span>
                                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>{{ $discussion->replies_count }} balasan</span>
                                </div>

                                <!-- Course & Lesson Info -->
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">{{ $discussion->lesson->module->course->title }}</span>
                                    <span class="mx-2">›</span>
                                    <span>{{ $discussion->lesson->module->title }}</span>
                                    <span class="mx-2">›</span>
                                    <span>{{ $discussion->lesson->title }}</span>
                                </div>

                                <!-- Content Preview -->
                                <p class="text-gray-700 line-clamp-2">
                                    {{ Str::limit(strip_tags($discussion->content), 200) }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col space-y-2 ml-4">
                                <form method="POST" action="{{ route('admin.forum.toggle-pin', $discussion) }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm {{ $discussion->is_pinned ? 'text-yellow-600 hover:text-yellow-800' : 'text-gray-600 hover:text-gray-800' }}">
                                        {{ $discussion->is_pinned ? 'Unpin' : 'Pin' }}
                                    </button>
                                </form>

                                <a href="{{ route('admin.forum.show', $discussion) }}"
                                    class="text-sm text-primary-600 hover:text-primary-800">
                                    Detail
                                </a>

                                <form method="POST" action="{{ route('admin.forum.destroy', $discussion) }}"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
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
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $discussions->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <h3 class="text-lg font-medium text-dark-700 mb-2">Tidak ada diskusi ditemukan</h3>
            <p class="text-dark-400 mb-4">
                @if (request('search') || request('course_id') || request('pinned'))
                    Coba ubah filter atau kata kunci pencarian Anda
                @else
                    Belum ada diskusi yang dibuat oleh pegawai
                @endif
            </p>
            @if (request('search') || request('course_id') || request('pinned'))
                <a href="{{ route('admin.forum.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                    Lihat Semua Diskusi
                </a>
            @endif
        </div>
    @endif
@endsection
