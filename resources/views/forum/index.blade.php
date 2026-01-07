@extends('layouts.app')

@section('title', 'Forum Diskusi')

@section('content')
    <div class="bg-white py-8 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-dark-700 mb-4">Forum Diskusi</h1>
            <p class="text-lg text-dark-400">Bertanya, berbagi pengetahuan, dan diskusi dengan pegawai lainnya</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Filter & Search -->
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <form method="GET" action="{{ route('forum.index') }}" class="flex flex-col md:flex-row gap-4">
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

                <!-- Submit Button -->
                <button type="submit"
                    class="px-6 py-2.5 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>

                @if (request('search') || request('course_id'))
                    <a href="{{ route('forum.index') }}"
                        class="px-6 py-2.5 border border-gray-300 text-dark-600 font-semibold rounded-lg hover:bg-gray-50 transition text-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Discussions List -->
        @if ($discussions->count() > 0)
            <div class="space-y-4">
                @foreach ($discussions as $discussion)
                    <div
                        class="bg-white rounded-lg border border-gray-200 p-6 hover:border-primary-200 hover:shadow-md transition">
                        <!-- Discussion Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    @if ($discussion->is_pinned)
                                        <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    @endif
                                    <a href="{{ route('forum.show', $discussion) }}"
                                        class="text-xl font-bold text-dark-700 hover:text-primary-600 transition">
                                        {{ $discussion->title }}
                                    </a>
                                </div>

                                <!-- Author & Meta -->
                                <div class="flex items-center text-sm text-dark-400 mb-3">
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

                                <!-- Course Path -->
                                <div class="text-sm text-dark-500 mb-3">
                                    <span
                                        class="font-medium text-primary-600">{{ $discussion->lesson->module->course->title }}</span>
                                    <span class="mx-2">›</span>
                                    <span>{{ $discussion->lesson->module->title }}</span>
                                    <span class="mx-2">›</span>
                                    <span>{{ $discussion->lesson->title }}</span>
                                </div>

                                <!-- Content Preview -->
                                <p class="text-dark-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($discussion->content), 200) }}
                                </p>
                            </div>
                        </div>

                        <!-- View Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('forum.show', $discussion) }}"
                                class="text-primary-600 hover:text-primary-700 font-medium text-sm flex items-center">
                                Lihat Diskusi
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
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
            <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <h3 class="text-lg font-medium text-dark-700 mb-2">Belum ada diskusi</h3>
                <p class="text-dark-400 mb-4">
                    @if (request('search') || request('course_id'))
                        Tidak ada diskusi yang sesuai dengan filter Anda
                    @else
                        Jadilah yang pertama membuat diskusi!
                    @endif
                </p>
                @if (request('search') || request('course_id'))
                    <a href="{{ route('forum.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                        Lihat Semua Diskusi
                    </a>
                @endif
            </div>
        @endif
    </div>
@endsection
