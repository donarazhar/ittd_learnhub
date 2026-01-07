@extends('layouts.app')

@section('title', $currentLesson->title . ' - ' . $course->title)

@push('styles')
    <style>
        /* Hide main navbar and footer */
        nav.bg-white.shadow-sm,
        header nav,
        footer {
            display: none !important;
        }

        body {
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Custom navigation bar styling */
        .custom-nav {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }

        /* Content wrapper */
        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
            padding: 2rem;
            padding-bottom: 120px;
        }

        /* Main content area */
        .main-content {
            min-width: 0;
        }

        /* Lesson content styling */
        .lesson-content {
            line-height: 1.65;
            color: #4b5563;
            font-size: 1.0625rem;
        }

        .lesson-content h1,
        .lesson-content h2,
        .lesson-content h3 {
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.6em;
            color: #1f2937;
            line-height: 1.3;
        }

        .lesson-content h1 {
            font-size: 2.25em;
        }

        .lesson-content h2 {
            font-size: 1.875em;
        }

        .lesson-content h3 {
            font-size: 1.5em;
        }

        .lesson-content p {
            margin-bottom: 0.85em;
            color: #4b5563;
            line-height: 1.65;
        }

        .lesson-content ul,
        .lesson-content ol {
            margin: 0.85em 0;
            padding-left: 2em;
        }

        .lesson-content li {
            margin-bottom: 0.4em;
        }

        .lesson-content a {
            color: #0053C5;
            text-decoration: underline;
        }

        .lesson-content strong {
            font-weight: 700;
            color: #1f2937;
        }

        .lesson-content code {
            background-color: #f3f4f6;
            padding: 0.2em 0.5em;
            border-radius: 0.25rem;
            font-family: 'Courier New', monospace;
            font-size: 0.875em;
            color: #dc2626;
        }

        .lesson-content pre {
            background-color: #1f2937;
            color: #f3f4f6;
            padding: 1.25em;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1em 0;
        }

        .lesson-content pre code {
            background: none;
            color: inherit;
            padding: 0;
        }

        /* Sidebar styling */
        .sidebar {
            position: sticky;
            top: 80px;
            height: fit-content;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .sidebar-tabs {
            display: flex;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 1.5rem;
        }

        .sidebar-tab {
            flex: 1;
            padding: 0.75rem 0.5rem;
            text-align: center;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
            font-size: 0.875rem;
        }

        .sidebar-tab:hover {
            color: #111827;
        }

        .sidebar-tab.active {
            color: #0053C5;
            border-bottom-color: #0053C5;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #e5e7eb;
            border-radius: 9999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
            transition: width 0.3s ease;
        }

        .module-item {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .module-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            font-weight: 600;
            color: #111827;
            cursor: pointer;
            transition: color 0.2s;
        }

        .module-header:hover {
            color: #0053C5;
        }

        .module-header svg {
            width: 1rem;
            height: 1rem;
            transition: transform 0.2s;
        }

        .module-header.open svg {
            transform: rotate(90deg);
        }

        .lesson-list {
            padding-left: 0.5rem;
            margin-top: 0.5rem;
        }

        .lesson-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.625rem 0.75rem;
            margin-bottom: 0.25rem;
            border-radius: 0.375rem;
            color: #4b5563;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .lesson-item:hover {
            background-color: #f3f4f6;
        }

        .lesson-item.active {
            background-color: #dbeafe;
            color: #1e40af;
            font-weight: 500;
        }

        .lesson-item.completed {
            color: #059669;
        }

        .lesson-item .checkmark {
            color: #059669;
            width: 1rem;
            height: 1rem;
        }

        /* Bottom navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            z-index: 40;
        }

        .bottom-nav-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 1rem;
            padding: 1rem 2rem;
            align-items: center;
        }

        .nav-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-button:hover:not(.disabled) {
            background-color: #f3f4f6;
            border-color: #0053C5;
            color: #0053C5;
        }

        .nav-button.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .nav-button svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .nav-button.nav-right {
            justify-content: flex-end;
            justify-self: end;
        }

        .current-lesson-title {
            text-align: center;
            font-weight: 600;
            color: #111827;
            font-size: 0.875rem;
        }

        /* Discussion Styles */
        .discussion-item {
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s;
        }

        .discussion-item:hover {
            border-color: #0053C5;
            background-color: #f9fafb;
        }
    </style>
@endpush

@section('content')
    <!-- Custom Top Navigation -->
    <div class="custom-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center mr-8">
                    <div class="p-2 bg-gradient-primary rounded-lg">
                        <img src="{{ asset('img/logo-hitam.png') }}" alt="IT Learning Hub" class="h-12 w-auto">
                    </div>
                    <span class="ml-2 text-lg font-bold text-dark-700">ITTD Learning Hub</span>
                </a>
                <div>
                    <h1 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0;">{{ $course->title }}</h1>
                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">{{ $currentLesson->module->title }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Mark Complete Button -->
                @if (!$userProgress || !$userProgress->is_completed)
                    <button onclick="markAsComplete()"
                        style="padding: 0.5rem 1rem; background-color: #10b981; color: white; border: none; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                        ✓ Tandai Selesai
                    </button>
                @else
                    <div
                        style="padding: 0.5rem 1rem; background-color: #d1fae5; color: #047857; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500;">
                        ✓ Selesai
                    </div>
                @endif

                <a href="{{ route('courses.show', $course->slug) }}"
                    style="padding: 0.5rem 1rem; background: white; color: #374151; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; cursor: pointer; text-decoration: none;">
                    Keluar
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Video Player (if exists) -->
            @if ($currentLesson->video_url)
                <div
                    style="position: relative; padding-bottom: 56.25%; margin-bottom: 2rem; background: #000; border-radius: 0.5rem; overflow: hidden;">
                    <div id="player" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
                </div>
            @endif

            <!-- Lesson Title -->
            <h1 style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">
                {{ $currentLesson->title }}
            </h1>

            <!-- Lesson Content -->
            @if ($currentLesson->content)
                <div class="lesson-content">
                    {!! $currentLesson->content !!}
                </div>
            @else
                <p style="color: #6b7280; font-style: italic;">Konten materi belum tersedia.</p>
            @endif
        </div>

        <!-- Sidebar with 3 Tabs -->
        <div class="sidebar">
            <!-- Tabs Header -->
            <div class="sidebar-tabs">
                <div class="sidebar-tab active" onclick="switchTab('contents')">Daftar Isi</div>
                <div class="sidebar-tab" onclick="switchTab('notes')">Catatan</div>
                <div class="sidebar-tab" onclick="switchTab('discussions')">💬 Diskusi</div>
            </div>

            <!-- Tab Content: Contents -->
            <div id="contents-tab" class="tab-content active">
                <!-- Progress Bar -->
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.875rem; font-weight: 600; color: #111827;">Progress Kursus</span>
                        <span style="font-size: 0.875rem; font-weight: 600; color: #059669;">
                            {{ $enrollment ? number_format($enrollment->progress_percentage, 0) : 0 }}%
                        </span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"
                            style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%;"></div>
                    </div>
                </div>

                <!-- Modules List -->
                @foreach ($course->modules as $module)
                    <div class="module-item">
                        <div class="module-header open" onclick="toggleModule(this)">
                            <span>{{ $module->title }}</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <div class="lesson-list" style="display: block;">
                            @foreach ($module->lessons as $lesson)
                                @php
                                    $lessonProgress = $lesson->getProgressFor(auth()->user());
                                    $isCompleted = $lessonProgress && $lessonProgress->is_completed;
                                    $isActive = $lesson->id === $currentLesson->id;
                                @endphp
                                <a href="{{ route('learn.show', [$course->slug, $lesson->slug]) }}"
                                    class="lesson-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}"
                                    style="text-decoration: none;">
                                    <span>{{ $lesson->title }}</span>
                                    @if ($isCompleted)
                                        <svg class="checkmark" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tab Content: Notes -->
            <div id="notes-tab" class="tab-content" x-data="{ showNoteForm: false }">
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0;">Catatan Saya</h3>
                        <button @click="showNoteForm = !showNoteForm"
                            style="color: #0053C5; font-weight: 500; background: none; border: none; cursor: pointer;">
                            + Tambah Catatan
                        </button>
                    </div>

                    <div x-show="showNoteForm"
                        style="margin-bottom: 1rem; padding: 1rem; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; display: none;">
                        <form onsubmit="saveNote(event)">
                            <textarea id="noteInput" rows="3" placeholder="Tulis catatan Anda..." required
                                style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 0.75rem;"></textarea>
                            <div style="display: flex; gap: 0.5rem;">
                                <button type="submit"
                                    style="padding: 0.5rem 1rem; background-color: #0053C5; color: white; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;">
                                    Simpan
                                </button>
                                <button type="button" @click="showNoteForm = false"
                                    style="padding: 0.5rem 1rem; background: white; color: #374151; border: 1px solid #d1d5db; border-radius: 0.375rem; cursor: pointer;">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="notesList">
                        @forelse ($notes as $note)
                            <div
                                style="padding: 1rem; background-color: #fef9c3; border: 1px solid #fde047; border-radius: 0.375rem; margin-bottom: 0.75rem;">
                                <p style="color: #111827; white-space: pre-wrap; margin: 0;">{{ $note->note }}</p>
                                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.5rem; margin-bottom: 0;">
                                    {{ $note->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p style="color: #6b7280; text-align: center; padding: 2rem 0; font-size: 0.875rem;">
                                Belum ada catatan.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Tab Content: Discussions -->
            <div id="discussions-tab" class="tab-content" x-data="{ showDiscussionForm: false }">
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0;">💬 Diskusi</h3>
                        <button @click="showDiscussionForm = !showDiscussionForm"
                            style="color: #0053C5; font-weight: 500; background: none; border: none; cursor: pointer;">
                            + Buat Diskusi
                        </button>
                    </div>

                    <!-- Create Discussion Form -->
                    <div x-show="showDiscussionForm"
                        style="margin-bottom: 1rem; padding: 1rem; background-color: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 0.5rem; display: none;">
                        <form method="POST" action="{{ route('forum.store') }}">
                            @csrf
                            <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                            <div style="margin-bottom: 0.75rem;">
                                <input type="text" name="title" placeholder="Judul diskusi..." required
                                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 0.5rem;">
                            </div>
                            <textarea name="content" rows="3" placeholder="Tulis pertanyaan atau topik diskusi..." required
                                style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; margin-bottom: 0.75rem;"></textarea>
                            <div style="display: flex; gap: 0.5rem;">
                                <button type="submit"
                                    style="padding: 0.5rem 1rem; background-color: #0053C5; color: white; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;">
                                    Posting
                                </button>
                                <button type="button" @click="showDiscussionForm = false"
                                    style="padding: 0.5rem 1rem; background: white; color: #374151; border: 1px solid #d1d5db; border-radius: 0.375rem; cursor: pointer;">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Discussions List -->
                    <div id="discussionsList">
                        @forelse ($discussions as $discussion)
                            <div class="discussion-item">
                                <h4 style="font-size: 0.9375rem; font-weight: 600; color: #111827; margin: 0 0 0.5rem 0;">
                                    {{ $discussion->title }}
                                </h4>
                                <div
                                    style="display: flex; align-items: center; font-size: 0.75rem; color: #6b7280; margin-bottom: 0.5rem;">
                                    <span>{{ $discussion->user->name }}</span>
                                    <span style="margin: 0 0.5rem;">•</span>
                                    <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                </div>
                                <p style="font-size: 0.875rem; color: #4b5563; margin: 0 0 0.5rem 0;">
                                    {{ Str::limit($discussion->content, 100) }}
                                </p>
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <span style="font-size: 0.75rem; color: #6b7280;">
                                        💬 {{ $discussion->replies_count }} balasan
                                    </span>
                                    <a href="{{ route('forum.show', $discussion) }}"
                                        style="font-size: 0.75rem; color: #0053C5; font-weight: 500; text-decoration: none;">
                                        Lihat →
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p style="color: #6b7280; text-align: center; padding: 2rem 0; font-size: 0.875rem;">
                                Belum ada diskusi untuk materi ini.
                            </p>
                        @endforelse
                    </div>

                    <!-- View All Discussions Link -->
                    @if ($discussions->count() > 0)
                        <div style="text-align: center; margin-top: 1rem;">
                            <a href="{{ route('forum.index') }}?course_id={{ $course->id }}"
                                style="font-size: 0.875rem; color: #0053C5; font-weight: 500; text-decoration: none;">
                                Lihat Semua Diskusi →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Bottom Navigation -->
    @php
        $allLessons = collect();
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $allLessons->push($lesson);
            }
        }

        $currentIndex = $allLessons->search(function ($lesson) use ($currentLesson) {
            return $lesson->id === $currentLesson->id;
        });

        $previousLesson = $currentIndex > 0 ? $allLessons[$currentIndex - 1] : null;
        $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons[$currentIndex + 1] : null;
    @endphp

    <div class="bottom-nav">
        <div class="bottom-nav-inner">
            @if ($previousLesson)
                <a href="{{ route('learn.show', [$course->slug, $previousLesson->slug]) }}" class="nav-button nav-left">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>{{ Str::limit($previousLesson->title, 25) }}</span>
                </a>
            @else
                <div class="nav-button nav-left disabled">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Materi Pertama</span>
                </div>
            @endif

            <div class="current-lesson-title">
                {{ $currentLesson->title }}
            </div>

            @if ($nextLesson)
                <a href="{{ route('learn.show', [$course->slug, $nextLesson->slug]) }}" class="nav-button nav-right">
                    <span>{{ Str::limit($nextLesson->title, 25) }}</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <div class="nav-button nav-right disabled">
                    <span>Materi Terakhir</span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    @if ($currentLesson->video_url)
        <script src="https://www.youtube.com/iframe_api"></script>
        <script>
            let player;
            let progressInterval;

            function onYouTubeIframeAPIReady() {
                const videoId = getYouTubeVideoId('{{ $currentLesson->video_url }}');
                player = new YT.Player('player', {
                    videoId: videoId,
                    playerVars: {
                        autoplay: 0,
                        controls: 1,
                        modestbranding: 1,
                        rel: 0
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                @if ($userProgress && $userProgress->last_position > 0)
                    player.seekTo({{ $userProgress->last_position }});
                @endif
            }

            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING) {
                    startProgressTracking();
                } else {
                    stopProgressTracking();
                }
            }

            function startProgressTracking() {
                progressInterval = setInterval(() => {
                    const currentTime = Math.floor(player.getCurrentTime());
                    updateProgress(currentTime, false);
                }, 5000);
            }

            function stopProgressTracking() {
                if (progressInterval) {
                    clearInterval(progressInterval);
                    const currentTime = Math.floor(player.getCurrentTime());
                    updateProgress(currentTime, false);
                }
            }

            function getYouTubeVideoId(url) {
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[2].length === 11) ? match[2] : null;
            }

            window.addEventListener('beforeunload', () => {
                if (player && player.getCurrentTime) {
                    const currentTime = Math.floor(player.getCurrentTime());
                    updateProgress(currentTime, false);
                }
            });
        </script>
    @endif

    <script>
        function updateProgress(lastPosition, isCompleted) {
            fetch('{{ route('learn.progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lesson_id: {{ $currentLesson->id }},
                        is_completed: isCompleted,
                        last_position: lastPosition
                    })
                }).then(response => response.json())
                .then(data => {
                    if (isCompleted && data.success) {
                        location.reload();
                    }
                });
        }

        function markAsComplete() {
            updateProgress(0, true);
        }

        function saveNote(event) {
            event.preventDefault();
            const noteInput = document.getElementById('noteInput');
            fetch('{{ route('learn.notes') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lesson_id: {{ $currentLesson->id }},
                        note: noteInput.value
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        function switchTab(tabName) {
            document.querySelectorAll('.sidebar-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            event.target.classList.add('active');
            document.getElementById(tabName + '-tab').classList.add('active');
        }

        function toggleModule(element) {
            element.classList.toggle('open');
            const lessonList = element.nextElementSibling;
            if (lessonList.style.display === 'none' || lessonList.style.display === '') {
                lessonList.style.display = 'block';
            } else {
                lessonList.style.display = 'none';
            }
        }
    </script>
@endpush
