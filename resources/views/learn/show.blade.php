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

        /* Content wrapper with transition */
        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 2rem;
            padding: 2rem;
            padding-bottom: 120px;
            transition: grid-template-columns 0.3s ease;
        }

        .content-wrapper.sidebar-collapsed {
            grid-template-columns: 1fr 0px;
            gap: 0;
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
        .lesson-content h3,
        .lesson-content h4,
        .lesson-content h5,
        .lesson-content h6 {
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

        .lesson-content h4 {
            font-size: 1.25em;
        }

        .lesson-content h5 {
            font-size: 1.125em;
        }

        .lesson-content h6 {
            font-size: 1em;
        }

        .lesson-content p {
            margin-bottom: 1em;
            color: #4b5563;
            line-height: 1.65;
        }

        /* Bullet lists and numbered lists */
        .lesson-content ul,
        .lesson-content ol {
            margin: 1em 0;
            padding-left: 2em;
            color: #4b5563;
        }

        .lesson-content ul {
            list-style-type: disc;
        }

        .lesson-content ol {
            list-style-type: decimal;
        }

        .lesson-content li {
            margin-bottom: 0.5em;
            line-height: 1.65;
        }

        .lesson-content ul ul,
        .lesson-content ol ul {
            list-style-type: circle;
            margin-top: 0.5em;
        }

        .lesson-content ul ul ul,
        .lesson-content ol ul ul {
            list-style-type: square;
        }

        /* Links */
        .lesson-content a {
            color: #0053C5;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .lesson-content a:hover {
            color: #003378;
        }

        /* Bold and emphasis */
        .lesson-content strong,
        .lesson-content b {
            font-weight: 700;
            color: #1f2937;
        }

        .lesson-content em,
        .lesson-content i {
            font-style: italic;
        }

        /* Blockquote */
        .lesson-content blockquote {
            border-left: 4px solid #0053C5;
            padding-left: 1em;
            margin: 1em 0;
            color: #6b7280;
            font-style: italic;
        }

        /* Tables */
        .lesson-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1em 0;
        }

        .lesson-content th,
        .lesson-content td {
            border: 1px solid #e5e7eb;
            padding: 0.75em;
            text-align: left;
        }

        .lesson-content th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #1f2937;
        }

        /* Horizontal rule */
        .lesson-content hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 2em 0;
        }

        /* Images */
        .lesson-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1em 0;
        }

        /* Code Block Styles - Cream Theme */
        .lesson-content pre,
        .lesson-content pre[class*="language-"] {
            position: relative;
            background-color: #faf8f3 !important;
            color: #2d2d2d !important;
            border: 1px solid #e8e4dc !important;
            border-radius: 0.5rem;
            padding: 1.5rem 1.5rem 1.5rem 1.5rem;
            padding-right: 5.5rem;
            margin: 1.5rem 0;
            overflow-x: auto;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', 'Consolas', 'source-code-pro', monospace !important;
            font-size: 0.875rem;
            line-height: 1.7;
            font-style: normal !important;
        }

        .lesson-content code,
        .lesson-content pre code {
            background-color: transparent !important;
            color: #2d2d2d !important;
            font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', 'Consolas', 'source-code-pro', monospace !important;
            padding: 0 !important;
            border-radius: 0 !important;
            display: block;
            font-style: normal !important;
        }

        /* Inline code */
        .lesson-content p code,
        .lesson-content li code,
        .lesson-content h1 code,
        .lesson-content h2 code,
        .lesson-content h3 code {
            background-color: #fff4e6 !important;
            color: #d97706 !important;
            padding: 0.2rem 0.4rem !important;
            border-radius: 0.25rem !important;
            font-size: 0.875em !important;
            display: inline !important;
            font-style: normal !important;
            border: 1px solid #fed7aa !important;
        }

        /* Copy Button */
        .copy-button {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: #2d2d2d;
            border: 1px solid #2d2d2d;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .copy-button:hover {
            background: #1a1a1a;
            border-color: #1a1a1a;
        }

        .copy-button.copied {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        /* Completion Section Styling */
        .completion-section {
            margin-top: 3rem;
            padding: 2rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 1rem;
            border: 2px solid #0ea5e9;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .completion-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .completion-section.completed {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-color: #10b981;
        }

        .completion-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .completion-icon svg {
            width: 48px;
            height: 48px;
        }

        .completion-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.75rem;
        }

        .completion-description {
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .complete-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            transition: all 0.3s ease;
        }

        .complete-button:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        .complete-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .complete-button svg {
            width: 24px;
            height: 24px;
        }

        .completed-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: white;
            color: #059669;
            border-radius: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .completed-badge svg {
            width: 24px;
            height: 24px;
        }

        /* Sidebar styling with transition */
        .sidebar {
            position: sticky;
            top: 80px;
            height: fit-content;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            transition: all 0.3s ease;
            width: 380px;
        }

        .sidebar.collapsed {
            width: 0;
            padding: 0;
            opacity: 0;
            overflow: hidden;
            pointer-events: none;
        }

        /* Floating toggle button when sidebar is collapsed */
        .sidebar-toggle-float {
            position: fixed;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            background: #0053C5;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
            transition: all 0.3s ease;
        }

        .sidebar-toggle-float:hover {
            background: #003378;
            transform: translateY(-50%) scale(1.1);
        }

        .sidebar-toggle-float svg {
            width: 24px;
            height: 24px;
        }

        .sidebar-toggle-float.show {
            display: flex;
        }

        /* Floating toggle button - moved to top left of sidebar */
        .sidebar-toggle {
            position: absolute;
            left: 1rem;
            top: 1rem;
            width: 36px;
            height: 36px;
            background: #0053C5;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            background: #003378;
        }

        .sidebar-toggle svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed .sidebar-toggle svg {
            transform: rotate(180deg);
        }

        /* Adjust sidebar to accommodate toggle button */
        .sidebar-header {
            position: relative;
            padding-top: 3rem;
        }

        .sidebar-tabs {
            display: flex;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 1.5rem;
            padding: 0 1rem;
            padding-left: 3.5rem;
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
            padding: 0 1rem 1rem 1rem;
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

        /* Module accordion - independent collapse */
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
            color: #3d3d3d;
            cursor: pointer;
            transition: color 0.2s;
        }

        .module-header:hover {
            color: #0053C5;
        }

        .module-header svg {
            width: 1rem;
            height: 1rem;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .module-header.open svg {
            transform: rotate(90deg);
        }

        .lesson-list {
            padding-left: 0.5rem;
            margin-top: 0.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .lesson-list.open {
            max-height: 2000px;
        }

        .lesson-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.625rem 0.75rem;
            margin-bottom: 0.25rem;
            border-radius: 0.375rem;
            color: #3d3d3d;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 400;
        }

        .lesson-item:hover {
            background-color: #f3f4f6;
        }

        .lesson-item.active {
            background-color: #dbeafe;
            color: #1e40af;
            font-weight: 700;
        }

        .lesson-item.completed {
            color: #059669;
        }

        .lesson-item.completed.active {
            color: #1e40af;
            font-weight: 700;
        }

        .lesson-item .checkmark {
            color: #059669;
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
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

        /* Scroll Progress Indicator */
        .scroll-progress {
            position: fixed;
            top: 64px;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #0053C5 0%, #10b981 100%);
            z-index: 51;
            transition: width 0.1s ease;
        }

        /* Responsive */
        @@media (max-width: 1024px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                right: 0;
                top: 64px;
                bottom: 0;
                width: 380px;
                max-width: 90vw;
                max-height: none;
                border-radius: 0;
                z-index: 45;
            }

            .sidebar.collapsed {
                transform: translateX(100%);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Floating Toggle Button (shows when sidebar is closed) -->
    <button class="sidebar-toggle-float" onclick="toggleSidebar()" id="sidebarToggleFloat">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Custom Top Navigation -->
    <div class="custom-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('courses.show', $course->slug) }}"
                    class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-primary-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0;">{{ $course->title }}</h1>
                    <p style="font-size: 0.75rem; color: #6b7280; margin: 0;">{{ $currentLesson->module->title }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Progress Indicator -->
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #059669;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #059669;">
                        {{ $enrollment ? number_format($enrollment->progress_percentage, 0) : 0 }}% Selesai
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper" id="contentWrapper">
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
            <div id="lessonContent">
                @if ($currentLesson->content)
                    <div class="lesson-content">
                        {!! $currentLesson->content !!}
                    </div>
                @else
                    <p style="color: #6b7280; font-style: italic;">Konten materi belum tersedia.</p>
                @endif
            </div>

            <!-- Completion Section -->
            <div class="completion-section {{ $userProgress && $userProgress->is_completed ? 'completed visible' : '' }}"
                id="completionSection">
                @if ($userProgress && $userProgress->is_completed)
                    <!-- Already Completed -->
                    <div class="completion-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <svg fill="white" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="completion-title" style="color: #059669;">Materi Selesai! 🎉</h2>
                    <p class="completion-description">
                        Anda telah menyelesaikan materi ini. Lanjutkan ke materi berikutnya untuk melanjutkan pembelajaran
                        Anda.
                    </p>
                    <div class="completed-badge">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Sudah Selesai</span>
                    </div>
                @else
                    <!-- Not Completed Yet -->
                    <div class="completion-icon">
                        <svg fill="#0ea5e9" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="completion-title">Selesai Membaca?</h2>
                    <p class="completion-description">
                        Tandai materi ini sebagai selesai untuk melacak progress pembelajaran Anda
                    </p>
                    <button class="complete-button" onclick="markAsComplete()" id="completeButton">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Tandai Selesai</span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Sidebar with 3 Tabs -->
        <div class="sidebar" id="sidebar">
            <!-- Toggle Button inside sidebar -->
            <button class="sidebar-toggle" onclick="toggleSidebar()" id="sidebarToggle">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Tabs Header -->
            <div class="sidebar-header">
                <div class="sidebar-tabs">
                    <div class="sidebar-tab active" onclick="switchTab('contents')">Daftar Isi</div>
                    <div class="sidebar-tab" onclick="switchTab('notes')">Catatan</div>
                    <div class="sidebar-tab" onclick="switchTab('discussions')">Diskusi</div>
                </div>
            </div>

            <!-- Tab Content: Contents -->
            <div id="contents-tab" class="tab-content active">
                <!-- Progress Bar -->
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.875rem; font-weight: 600; color: #111827;">Progres Kursus</span>
                        <span style="font-size: 0.875rem; font-weight: 600; color: #059669;">
                            {{ $enrollment ? number_format($enrollment->progress_percentage, 0) : 0 }}%
                        </span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"
                            style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%;"></div>
                    </div>
                </div>

                <!-- Modules List with Independent Collapse -->
                @foreach ($course->modules as $index => $module)
                    @php
                        $hasActiveLesson = $module->lessons->contains('id', $currentLesson->id);
                    @endphp
                    <div class="module-item" data-module-id="{{ $module->id }}">
                        <div class="module-header {{ $hasActiveLesson ? 'open' : '' }}"
                            onclick="toggleModule({{ $module->id }})">
                            <span>{{ $module->title }}</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <div class="lesson-list {{ $hasActiveLesson ? 'open' : '' }}" id="module-{{ $module->id }}">
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
                                    {{ optional($note->created_at)->diffForHumans() ?? 'Baru saja' }}</p>
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
                        <h3 style="font-size: 1.125rem; font-weight: 700; color: #111827; margin: 0;">Diskusi</h3>
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
                                    <span>{{ optional($discussion->created_at)->diffForHumans() ?? 'Baru saja' }}</span>
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
        // Scroll Progress Indicator
        window.addEventListener('scroll', function() {
            const scrollProgress = document.getElementById('scrollProgress');
            const completionSection = document.getElementById('completionSection');
            const lessonContent = document.getElementById('lessonContent');

            // Calculate scroll progress
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollPercent = (scrollTop / (documentHeight - windowHeight)) * 100;

            // Update progress bar
            scrollProgress.style.width = scrollPercent + '%';

            // Show completion section when user scrolls to 80% or more
            if (scrollPercent >= 80 && !completionSection.classList.contains('visible')) {
                completionSection.classList.add('visible');
            }
        });

        // Sidebar toggle functionality
        let sidebarVisible = true;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const contentWrapper = document.getElementById('contentWrapper');
            const toggleFloatBtn = document.getElementById('sidebarToggleFloat');

            sidebarVisible = !sidebarVisible;

            if (sidebarVisible) {
                sidebar.classList.remove('collapsed');
                contentWrapper.classList.remove('sidebar-collapsed');
                toggleFloatBtn.classList.remove('show');
            } else {
                sidebar.classList.add('collapsed');
                contentWrapper.classList.add('sidebar-collapsed');
                toggleFloatBtn.classList.add('show');
            }
        }

        // Independent module toggle
        function toggleModule(moduleId) {
            const moduleList = document.getElementById('module-' + moduleId);
            const moduleHeader = event.currentTarget;

            // Toggle current module
            const isOpen = moduleList.classList.contains('open');

            if (isOpen) {
                moduleList.classList.remove('open');
                moduleHeader.classList.remove('open');
            } else {
                moduleList.classList.add('open');
                moduleHeader.classList.add('open');
            }
        }

        function updateProgress(lastPosition, isCompleted) {
            return fetch('{{ route('learn.progress') }}', {
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
                })
                .then(response => response.json())
                .catch(error => {
                    console.error('Error updating progress:', error);
                    return {
                        success: false
                    };
                });
        }

        // ADVANCED FIX WITH MULTIPLE FALLBACK MECHANISMS
        // This ensures reload happens no matter what

        function markAsComplete() {
            const button = document.getElementById('completeButton');

            // Disable button
            button.disabled = true;
            button.innerHTML =
                '<svg style="width: 24px; height: 24px; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg><span>Menyimpan...</span>';

            // Flag to track if reload already triggered
            let reloadTriggered = false;

            // Fallback 1: Timeout after 3 seconds regardless of response
            const fallbackTimer = setTimeout(() => {
                if (!reloadTriggered) {
                    console.log('Fallback reload triggered');
                    reloadTriggered = true;
                    forceReload();
                }
            }, 3000);

            // Function to reload with cache busting
            function forceReload() {
                button.innerHTML =
                    '<svg style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg><span>Berhasil!</span>';

                setTimeout(() => {
                    // Method 1: Try with cache busting
                    const currentUrl = window.location.href.split('?')[0].split('#')[0];
                    window.location.href = currentUrl + '?_t=' + Date.now();

                    // Fallback 2: If above doesn't work in 500ms, try hard reload
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 500);
                }, 500);
            }

            // Send request
            fetch('{{ route('learn.progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        lesson_id: {{ $currentLesson->id }},
                        is_completed: true,
                        last_position: 0
                    })
                })
                .then(response => {
                    // Cancel fallback timer since we got response
                    clearTimeout(fallbackTimer);

                    if (!reloadTriggered) {
                        reloadTriggered = true;
                        forceReload();
                    }

                    return response.text(); // Get as text first to handle any response
                })
                .then(text => {
                    console.log('Server response:', text);
                })
                .catch(error => {
                    console.error('Request error:', error);

                    // Cancel fallback timer
                    clearTimeout(fallbackTimer);

                    // Reload anyway since data is saved
                    if (!reloadTriggered) {
                        reloadTriggered = true;
                        forceReload();
                    }
                });
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

        // Add spin animation for loading state
        const style = document.createElement('style');
        style.textContent = '@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }';
        document.head.appendChild(style);

        // Code Block Enhancement for Lesson Content
        document.addEventListener('DOMContentLoaded', function() {
            const lessonContent = document.querySelector('.lesson-content');
            if (!lessonContent) return;

            lessonContent.querySelectorAll('pre').forEach(block => {
                if (block.querySelector('.copy-button')) return;

                const code = block.querySelector('code') || block;
                const text = code.textContent || code.innerText;

                const button = document.createElement('button');
                button.className = 'copy-button';
                button.textContent = 'Copy';
                button.onclick = async function() {
                    try {
                        await navigator.clipboard.writeText(text);
                        button.textContent = 'Copied!';
                        button.classList.add('copied');
                        setTimeout(() => {
                            button.textContent = 'Copy';
                            button.classList.remove('copied');
                        }, 2000);
                    } catch (e) {
                        console.error('Copy failed:', e);
                    }
                };

                block.style.position = 'relative';
                block.appendChild(button);
            });
        });
    </script>
@endpush
