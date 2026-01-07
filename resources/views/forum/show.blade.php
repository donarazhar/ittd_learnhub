@extends('layouts.app')

@section('title', $discussion->title)

@section('content')
    <div class="bg-white py-8 border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('forum.index') }}"
                class="inline-flex items-center text-sm text-dark-500 hover:text-dark-700 mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Forum
            </a>
            <h1 class="text-3xl font-bold text-dark-700">{{ $discussion->title }}</h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Course Path -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-center text-sm">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-medium text-blue-800">{{ $discussion->lesson->module->course->title }}</span>
                <span class="mx-2 text-blue-400">›</span>
                <span class="text-blue-700">{{ $discussion->lesson->module->title }}</span>
                <span class="mx-2 text-blue-400">›</span>
                <span class="text-blue-700">{{ $discussion->lesson->title }}</span>
            </div>
            <a href="{{ route('learn.show', [$discussion->lesson->module->course->slug, $discussion->lesson->slug]) }}"
                class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium mt-2">
                Lihat Materi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Main Discussion -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm mb-6">
            <div class="p-6 border-b border-gray-200">
                <!-- Author Info -->
                <div class="flex items-center mb-4">
                    <div
                        class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                        {{ substr($discussion->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-dark-700">{{ $discussion->user->name }}</p>
                        <p class="text-sm text-dark-400">{{ $discussion->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose max-w-none text-dark-600">
                    {!! nl2br(e($discussion->content)) !!}
                </div>
            </div>

            <!-- Reply Count -->
            <div class="px-6 py-3 bg-gray-50 text-sm text-dark-500">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                {{ $discussion->replies_count }} {{ $discussion->replies_count === 1 ? 'Balasan' : 'Balasan' }}
            </div>
        </div>

        <!-- Replies Section -->
        @if ($discussion->replies->count() > 0)
            <div class="space-y-4 mb-6">
                @foreach ($discussion->replies as $reply)
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <!-- Author Info -->
                        <div class="flex items-center mb-4">
                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                                {{ substr($reply->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-dark-700">{{ $reply->user->name }}</p>
                                <p class="text-sm text-dark-400">{{ $reply->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <!-- Reply Content -->
                        <div class="prose max-w-none text-dark-600">
                            {!! nl2br(e($reply->content)) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Reply Form -->
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6">
            <h3 class="text-lg font-bold text-dark-700 mb-4">💬 Tambahkan Balasan</h3>
            <form method="POST" action="{{ route('forum.reply', $discussion) }}">
                @csrf
                <div class="mb-4">
                    <textarea name="content" rows="4" required placeholder="Tulis balasan Anda..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('content') border-red-300 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif
    </div>
@endsection
