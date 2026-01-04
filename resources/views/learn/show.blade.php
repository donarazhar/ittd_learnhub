<!-- resources/views/learn/show.blade.php -->

@extends('layouts.app')

@section('title', $currentLesson->title)

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700">Kursus</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('courses.show', $course->slug) }}"
                            class="text-gray-500 hover:text-gray-700">{{ Str::limit($course->title, 30) }}</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><span class="text-gray-900 font-medium">{{ $currentLesson->title }}</span></li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content (Left) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Lesson Title -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $currentLesson->title }}</h1>
                        <p class="text-sm text-gray-500">{{ $currentLesson->module->title }}</p>
                    </div>

                    <!-- Video Player -->
                    @if ($currentLesson->video_url)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="relative" style="padding-bottom: 56.25%;">
                                <iframe id="youtube-player" class="absolute top-0 left-0 w-full h-full"
                                    src="{{ str_replace('watch?v=', 'embed/', $currentLesson->video_url) }}?enablejsapi=1&rel=0"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif

                    <!-- Lesson Content with Scroll Tracking -->
                    <div class="bg-white rounded-lg shadow p-6" id="lesson-content">
                        <div class="prose max-w-none">
                            {!! $currentLesson->content !!}
                        </div>

                        <!-- References -->
                        @if ($currentLesson->references->count() > 0)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Referensi</h3>
                                <ul class="space-y-2">
                                    @foreach ($currentLesson->references as $reference)
                                        <li>
                                            <a href="{{ $reference->url }}" target="_blank"
                                                class="flex items-center text-primary-600 hover:text-primary-800">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                {{ $reference->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Attachments -->
                        @if ($currentLesson->attachments->count() > 0)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Lampiran</h3>
                                <div class="space-y-2">
                                    @foreach ($currentLesson->attachments as $attachment)
                                        <a href="{{ Storage::url($attachment->file_path) }}" target="_blank"
                                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                            <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">{{ $attachment->file_name }}
                                                </p>
                                                <p class="text-xs text-gray-500">{{ $attachment->formatted_size }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Scroll Progress Indicator -->
                        <div id="scroll-indicator" class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg hidden">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-blue-900">Progres Membaca</span>
                                <span id="scroll-percentage" class="text-sm font-bold text-blue-600">0%</span>
                            </div>
                            <div class="w-full bg-blue-200 rounded-full h-2">
                                <div id="scroll-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                                    style="width: 0%"></div>
                            </div>
                            <p class="text-xs text-blue-700 mt-2">Scroll ke bawah untuk menyelesaikan materi</p>
                        </div>

                        <!-- End of content marker -->
                        <div id="content-end-marker"></div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            @php
                                $prevLesson = null;
                                $nextLesson = null;
                                $allLessons = $course->lessons;
                                $currentIndex = $allLessons->search(function ($lesson) use ($currentLesson) {
                                    return $lesson->id === $currentLesson->id;
                                });

                                if ($currentIndex > 0) {
                                    $prevLesson = $allLessons[$currentIndex - 1];
                                }
                                if ($currentIndex < $allLessons->count() - 1) {
                                    $nextLesson = $allLessons[$currentIndex + 1];
                                }
                            @endphp

                            @if ($prevLesson)
                                <a href="{{ route('learn.show', [$course->slug, $prevLesson->slug]) }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Sebelumnya
                                </a>
                            @else
                                <div></div>
                            @endif

                            <div class="flex items-center space-x-3">
                                <div id="completion-status" class="text-sm">
                                    @if ($userProgress && $userProgress->is_completed)
                                        <span class="flex items-center text-green-600 font-medium">
                                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Materi Selesai
                                        </span>
                                    @else
                                        <span class="flex items-center text-gray-500 font-medium">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Belum Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if ($nextLesson)
                                <a href="{{ route('learn.show', [$course->slug, $nextLesson->slug]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                                    Selanjutnya
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <div></div>
                            @endif
                        </div>
                    </div>

                    <!-- Discussions -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Diskusi</h3>

                        <!-- Add Discussion Form -->
                        <form method="POST" action="{{ route('discussions.store') }}" class="mb-6">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                            <div class="space-y-3">
                                <input type="text" name="title" placeholder="Judul diskusi..." required
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <textarea name="content" rows="3" placeholder="Tulis pertanyaan atau diskusi Anda..." required
                                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"></textarea>
                                <button type="submit"
                                    class="px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition">
                                    Posting Diskusi
                                </button>
                            </div>
                        </form>

                        <!-- Discussions List -->
                        <div class="space-y-4">
                            @forelse($discussions as $discussion)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-primary flex items-center justify-center flex-shrink-0">
                                            <span class="text-white font-semibold">
                                                {{ substr($discussion->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="font-semibold text-gray-900">{{ $discussion->title }}</h4>
                                                <span
                                                    class="text-xs text-gray-500">{{ $discussion->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-3">{{ $discussion->user->name }}</p>
                                            <p class="text-gray-700 mb-3">{{ $discussion->content }}</p>

                                            <!-- Replies -->
                                            @if ($discussion->replies->count() > 0)
                                                <div class="mt-3 pl-4 border-l-2 border-gray-200 space-y-3">
                                                    @foreach ($discussion->replies as $reply)
                                                        <div class="flex items-start space-x-2">
                                                            <div
                                                                class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center flex-shrink-0">
                                                                <span class="text-gray-600 font-semibold text-sm">
                                                                    {{ substr($reply->user->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                            <div class="flex-1">
                                                                <p class="text-sm font-medium text-gray-900">
                                                                    {{ $reply->user->name }}</p>
                                                                <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                                                <span
                                                                    class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <!-- Reply Form -->
                                            <form method="POST" action="{{ route('discussions.reply', $discussion) }}"
                                                class="mt-3">
                                                @csrf
                                                <div class="flex space-x-2">
                                                    <input type="text" name="content" placeholder="Tulis balasan..."
                                                        required
                                                        class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-primary-600 text-white text-sm font-semibold rounded-lg hover:bg-primary-700 transition">
                                                        Balas
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 py-4">Belum ada diskusi. Jadilah yang pertama!</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Right) with Accordion -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow sticky top-6" x-data="{ activeTab: 'modules' }">
                        <!-- Tabs -->
                        <div class="flex border-b">
                            <button @click="activeTab = 'modules'"
                                :class="activeTab === 'modules' ? 'border-b-2 border-primary-500 text-primary-600' :
                                    'text-gray-600'"
                                class="flex-1 py-3 px-4 font-medium text-sm">
                                Daftar Modul
                            </button>
                            <button @click="activeTab = 'notes'"
                                :class="activeTab === 'notes' ? 'border-b-2 border-primary-500 text-primary-600' :
                                    'text-gray-600'"
                                class="flex-1 py-3 px-4 font-medium text-sm">
                                Catatan
                            </button>
                        </div>

                        <!-- Progress Bar -->
                        <div class="p-4 border-b">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Progress</span>
                                <span
                                    class="text-sm font-bold text-primary-600">{{ number_format($progressPercentage, 0) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-600 h-2 rounded-full transition-all duration-300"
                                    style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>

                        <!-- Modules Tab with Accordion -->
                        <div x-show="activeTab === 'modules'" class="p-4 max-h-[32rem] overflow-y-auto scrollbar-thin">
                            @foreach ($course->modules as $index => $module)
                                <div class="mb-2" x-data="{
                                    open: {{ $module->lessons->contains('id', $currentLesson->id) ? 'true' : 'false' }}
                                }">
                                    <!-- Module Header (Accordion Trigger) -->
                                    <button @click="open = !open"
                                        class="w-full flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition text-left">
                                        <div class="flex items-center space-x-2 flex-1">
                                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                                                :class="open ? 'rotate-90' : ''" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <h4 class="font-semibold text-gray-800 text-sm">{{ $module->title }}</h4>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-2">{{ $module->lessons->count() }}</span>
                                    </button>

                                    <!-- Module Lessons (Accordion Content) -->
                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-2" class="mt-2 ml-2 space-y-1"
                                        style="{{ $module->lessons->contains('id', $currentLesson->id) ? '' : 'display: none;' }}">
                                        @foreach ($module->lessons as $lesson)
                                            <a href="{{ route('learn.show', [$course->slug, $lesson->slug]) }}"
                                                class="flex items-center p-2 rounded text-sm hover:bg-gray-100 transition
                                          {{ $currentLesson->id === $lesson->id ? 'bg-primary-50 border-l-2 border-primary-500' : '' }}">
                                                @if ($lesson->isCompletedBy(auth()->user()))
                                                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="10" stroke-width="2" />
                                                    </svg>
                                                @endif
                                                <span
                                                    class="{{ $currentLesson->id === $lesson->id ? 'font-semibold text-primary-600' : 'text-gray-700' }}">
                                                    {{ $lesson->title }}
                                                </span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Notes Tab -->
                        <div x-show="activeTab === 'notes'" class="p-4" style="display: none;">
                            <form id="noteForm" class="mb-4">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                                <textarea name="note" rows="3"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                    placeholder="Tulis catatan Anda..."></textarea>
                                <button type="submit"
                                    class="mt-2 w-full bg-primary-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition">
                                    Simpan Catatan
                                </button>
                            </form>

                            <div id="notesList" class="space-y-3 max-h-64 overflow-y-auto scrollbar-thin">
                                @forelse($notes as $note)
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-sm text-gray-700">{{ $note->note }}</p>
                                        <span
                                            class="text-xs text-gray-500">{{ $note->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 text-center py-4">Belum ada catatan.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Scroll Tracking untuk Auto Complete
            (function() {
                const contentElement = document.getElementById('lesson-content');
                const scrollIndicator = document.getElementById('scroll-indicator');
                const scrollBar = document.getElementById('scroll-bar');
                const scrollPercentage = document.getElementById('scroll-percentage');
                const completionStatus = document.getElementById('completion-status');

                let hasScrolledToBottom = false;
                let scrollThreshold = 90; // 90% dari konten harus dibaca

                // Check if already completed
                const isCompleted = {{ $userProgress && $userProgress->is_completed ? 'true' : 'false' }};

                if (!isCompleted && scrollIndicator) {
                    scrollIndicator.classList.remove('hidden');

                    window.addEventListener('scroll', function() {
                        const windowHeight = window.innerHeight;
                        const documentHeight = contentElement.scrollHeight;
                        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                        const contentTop = contentElement.offsetTop;
                        const contentBottom = contentTop + documentHeight;

                        // Calculate scroll percentage within content
                        const scrolled = scrollTop + windowHeight - contentTop;
                        const scrollableHeight = documentHeight;
                        const percentage = Math.min(100, Math.max(0, (scrolled / scrollableHeight) * 100));

                        // Update progress bar
                        if (scrollBar && scrollPercentage) {
                            scrollBar.style.width = percentage + '%';
                            scrollPercentage.textContent = Math.round(percentage) + '%';
                        }

                        // Auto complete when scrolled past threshold
                        if (percentage >= scrollThreshold && !hasScrolledToBottom) {
                            hasScrolledToBottom = true;
                            markAsComplete();
                        }
                    });
                }
            })();

            // Mark as complete
            function markAsComplete() {
                fetch('{{ route('learn.progress') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            lesson_id: {{ $currentLesson->id }},
                            is_completed: true
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update UI without reload
                            const completionStatus = document.getElementById('completion-status');
                            if (completionStatus) {
                                completionStatus.innerHTML = `
                    <span class="flex items-center text-green-600 font-medium">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Materi Selesai
                    </span>
                `;
                            }

                            // Hide scroll indicator
                            const scrollIndicator = document.getElementById('scroll-indicator');
                            if (scrollIndicator) {
                                scrollIndicator.classList.add('hidden');
                            }

                            // Show success notification
                            showNotification('Selamat! Anda telah menyelesaikan materi ini.', 'success');

                            // Reload after 2 seconds to update progress
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Save notes
            document.getElementById('noteForm')?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(e.target);

                const response = await fetch('{{ route('learn.notes') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });

                if (response.ok) {
                    showNotification('Catatan berhasil disimpan!', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });

            // Notification helper
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-600' : 'bg-red-600'
    } text-white font-medium`;
                notification.textContent = message;
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }
        </script>
    @endpush
@endsection
