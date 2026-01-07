{{-- resources/views/admin/forum/show.blade.php --}}

@extends('layouts.admin')

@section('title', $discussion->title)

@section('content')
    <div class="max-w-5xl">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.forum.index') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Forum
            </a>
        </div>

        <!-- Discussion -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
            <!-- Discussion Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        @if ($discussion->is_pinned)
                            <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium text-yellow-700 mr-3">Pinned</span>
                        @endif
                        <h1 class="text-xl font-bold text-gray-900">{{ $discussion->title }}</h1>
                    </div>

                    <div class="flex items-center space-x-2">
                        <form method="POST" action="{{ route('admin.forum.toggle-pin', $discussion) }}">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1.5 text-sm {{ $discussion->is_pinned ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg transition">
                                {{ $discussion->is_pinned ? 'Unpin' : 'Pin' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.forum.destroy', $discussion) }}"
                            onsubmit="return confirm('Yakin ingin menghapus diskusi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1.5 text-sm bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition">
                                Hapus Diskusi
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Course & Lesson Info -->
                <div class="mt-3 text-sm text-gray-600">
                    <span class="font-medium">{{ $discussion->lesson->module->course->title }}</span>
                    <span class="mx-2">›</span>
                    <span>{{ $discussion->lesson->module->title }}</span>
                    <span class="mx-2">›</span>
                    <span>{{ $discussion->lesson->title }}</span>
                </div>
            </div>

            <!-- Discussion Content -->
            <div class="p-6">
                <!-- Author Info -->
                <div class="flex items-center mb-4">
                    <div
                        class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center text-white font-semibold mr-3">
                        {{ substr($discussion->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $discussion->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $discussion->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($discussion->content)) !!}
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900">
                    Balasan ({{ $discussion->replies_count }})
                </h2>
            </div>

            @if ($discussion->replies->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach ($discussion->replies as $reply)
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <!-- Author Info -->
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $reply->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $reply->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Reply Content -->
                                    <div class="pl-11 prose max-w-none text-gray-700">
                                        {!! nl2br(e($reply->content)) !!}
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('admin.forum.destroy-reply', $reply) }}"
                                    class="ml-4" onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-gray-500">Belum ada balasan untuk diskusi ini</p>
                </div>
            @endif
        </div>

        <!-- Reply Form for Admin/Kontributor -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">💬 Balas Diskusi</h3>
            <form method="POST" action="{{ route('forum.reply', $discussion) }}">
                @csrf
                <div class="mb-4">
                    <textarea name="content" rows="4" required placeholder="Tulis balasan Anda..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('content') border-red-300 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 inline mr-1 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Balasan Anda akan terlihat oleh semua pegawai
                    </p>
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
