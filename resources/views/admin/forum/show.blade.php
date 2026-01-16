{{-- resources/views/admin/forum/show.blade.php --}}

@extends('layouts.admin')

@section('title', $discussion->title)

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
            <a href="{{ route('admin.forum.index') }}" class="hover:text-[#0053C5] transition">
                Forum & Diskusi
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium truncate max-w-xs">{{ Str::limit($discussion->title, 40) }}</span>
        </nav>

        <!-- Back Button -->
        <a href="{{ route('admin.forum.index') }}"
            class="inline-flex items-center text-sm text-gray-600 hover:text-[#0053C5] mb-4 transition group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Forum
        </a>
    </div>

    <div class="max-w-5xl mx-auto">
        <!-- Main Discussion Card -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden mb-6">
            <!-- Discussion Header -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center flex-wrap gap-2 mb-3">
                            @if ($discussion->is_pinned)
                                <div
                                    class="flex items-center bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-full shadow-sm">
                                    <svg class="w-5 h-5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="text-sm font-bold">Dipasang</span>
                                </div>
                            @endif
                        </div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">{{ $discussion->title }}</h1>

                        <!-- Course & Lesson Info -->
                        <div class="flex items-center flex-wrap gap-2 text-sm">
                            <div
                                class="inline-flex items-center bg-white border border-blue-200 text-[#0053C5] px-3 py-1.5 rounded-lg shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="font-semibold">{{ $discussion->lesson->module->course->title }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-gray-600">{{ $discussion->lesson->module->title }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-gray-600">{{ $discussion->lesson->title }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-row lg:flex-col gap-2 lg:min-w-[140px]">
                        <form method="POST" action="{{ route('admin.forum.toggle-pin', $discussion) }}"
                            class="flex-1 lg:flex-none">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-semibold rounded-lg transition-all shadow-sm {{ $discussion->is_pinned ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 inline mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L11 4.323V3a1 1 0 011-1zm-5 8.274l-.818 2.552c-.25.78.133 1.632.91 1.882.777.25 1.632-.133 1.882-.91l.818-2.552c.25-.78-.133-1.632-.91-1.882-.777-.25-1.632.133-1.882.91zM15 13a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ $discussion->is_pinned ? 'Unpin' : 'Pin' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.forum.destroy', $discussion) }}"
                            onsubmit="return confirm('Yakin ingin menghapus diskusi ini? Tindakan ini tidak dapat dibatalkan.')"
                            class="flex-1 lg:flex-none">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-2.5 text-sm font-semibold bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-all shadow-sm">
                                <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Discussion Content -->
            <div class="p-6 lg:p-8">
                <!-- Author Info -->
                <div class="flex items-center mb-6 p-4 bg-gray-50 rounded-xl">
                    <div
                        class="h-14 w-14 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        {{ substr($discussion->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-lg">{{ $discussion->user->name }}</p>
                        <div class="flex items-center text-sm text-gray-600 mt-1">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $discussion->created_at->format('d M Y, H:i') }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($discussion->content)) !!}
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Balasan
                    </h2>
                    <div class="bg-[#0053C5] text-white px-4 py-2 rounded-full">
                        <span class="font-bold text-lg">{{ $discussion->replies_count }}</span>
                    </div>
                </div>
            </div>

            @if ($discussion->replies->count() > 0)
                <div class="divide-y divide-gray-100">
                    @foreach ($discussion->replies as $reply)
                        <div class="p-6 hover:bg-gray-50 transition-all">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <!-- Author Info -->
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="h-12 w-12 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center text-white font-bold text-lg mr-3 shadow-md">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $reply->user->name }}</p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $reply->created_at->format('d M Y, H:i') }}
                                                <span class="mx-2">•</span>
                                                {{ $reply->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reply Content -->
                                    <div class="pl-0 lg:pl-15 prose max-w-none text-gray-700 leading-relaxed">
                                        {!! nl2br(e($reply->content)) !!}
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('admin.forum.destroy-reply', $reply) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus balasan ini?')" class="flex-shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all">
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
                <!-- Empty State -->
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada balasan</h3>
                    <p class="text-gray-600">Jadilah yang pertama memberikan balasan untuk diskusi ini</p>
                </div>
            @endif
        </div>

        <!-- Reply Form -->
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 lg:p-8">
            <div class="flex items-center mb-6">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-[#0053C5] to-[#003d91] rounded-full flex items-center justify-center mr-3 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Balas Diskusi</h3>
            </div>

            <form method="POST" action="{{ route('forum.reply', $discussion) }}" class="space-y-4">
                @csrf
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tulis Balasan Anda
                    </label>
                    <textarea name="content" id="content" rows="5" required
                        placeholder="Tulis balasan yang membantu dan konstruktif..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>

                    @error('content')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @else
                        <div class="mt-3 p-3 bg-blue-50 border border-blue-100 rounded-lg">
                            <p class="text-sm text-gray-700 flex items-start">
                                <svg class="w-5 h-5 mr-2 text-[#0053C5] flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Balasan Anda akan terlihat oleh semua pegawai yang mengikuti diskusi ini.</span>
                            </p>
                        </div>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-[#0053C5] hover:bg-[#003d91] text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:scale-105 group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>

        <!-- Success Message Toast -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 z-50 animate-slide-in">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 hover:text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    </div>
@endsection

{{-- Custom Styles --}}
@push('styles')
    <style>
        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .prose {
            max-width: 100%;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
