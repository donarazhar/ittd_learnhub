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
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Custom Navigation */
        .learn-nav {
            background: linear-gradient(to right, #ffffff, #f8fafc);
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(12px);
        }

        .learn-nav-inner {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .learn-nav-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .back-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background: white;
            border: 1px solid #e2e8f0;
            color: #64748b;
            transition: all 0.2s ease;
        }

        .back-button:hover {
            background: #0053C5;
            border-color: #0053C5;
            color: white;
            transform: translateX(-2px);
        }

        .course-info h1 {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .course-info p {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .progress-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border: 1px solid #a7f3d0;
            border-radius: 2rem;
        }

        .progress-badge svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #059669;
        }

        .progress-badge span {
            font-size: 0.875rem;
            font-weight: 600;
            color: #059669;
        }

        /* Scroll Progress */
        .scroll-progress {
            position: fixed;
            top: 4rem;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #0053C5 0%, #3b82f6 50%, #10b981 100%);
            z-index: 51;
            transition: width 0.1s ease;
            box-shadow: 0 0 10px rgba(0, 83, 197, 0.3);
        }

        /* Main Layout */
        .learn-wrapper {
            max-width: 1600px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 2rem;
            padding: 2rem;
            padding-bottom: 7rem;
            transition: all 0.3s ease;
        }

        .learn-wrapper.sidebar-collapsed {
            grid-template-columns: 1fr 0;
            gap: 0;
        }

        .learn-content {
            min-width: 0;
        }

        /* Video Container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .video-container #player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Lesson Header */
        .lesson-header {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .lesson-title {
            font-size: 2rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 1rem 0;
            line-height: 1.3;
        }

        .lesson-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .lesson-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #64748b;
        }

        .lesson-meta-item svg {
            width: 1rem;
            height: 1rem;
        }

        .lesson-meta-item.primary {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #0053C5;
        }

        /* Lesson Content Card */
        .lesson-content-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Lesson Content Typography */
        .lesson-content {
            line-height: 1.8;
            color: #374151;
            font-size: 1.0625rem;
        }

        .lesson-content h1,
        .lesson-content h2,
        .lesson-content h3,
        .lesson-content h4 {
            font-weight: 700;
            margin-top: 2em;
            margin-bottom: 0.75em;
            color: #0f172a;
            line-height: 1.3;
        }

        .lesson-content h1 {
            font-size: 2em;
        }

        .lesson-content h2 {
            font-size: 1.75em;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5em;
        }

        .lesson-content h3 {
            font-size: 1.5em;
        }

        .lesson-content p {
            margin-bottom: 1.25em;
        }

        .lesson-content ul,
        .lesson-content ol {
            margin: 1.25em 0;
            padding-left: 1.5em;
        }

        .lesson-content ul {
            list-style-type: disc;
        }

        .lesson-content ol {
            list-style-type: decimal;
        }

        .lesson-content li {
            margin-bottom: 0.5em;
            padding-left: 0.5em;
        }

        .lesson-content a {
            color: #0053C5;
            text-decoration: underline;
        }

        .lesson-content a:hover {
            color: #003d91;
        }

        .lesson-content strong {
            font-weight: 700;
            color: #0f172a;
        }

        .lesson-content blockquote {
            border-left: 4px solid #0053C5;
            padding: 1rem 1.5rem;
            margin: 1.5em 0;
            background: linear-gradient(to right, #eff6ff, transparent);
            border-radius: 0 0.5rem 0.5rem 0;
            color: #475569;
            font-style: italic;
        }

        .lesson-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5em 0;
        }

        .lesson-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
        }

        .lesson-content th,
        .lesson-content td {
            padding: 0.875rem 1rem;
            border: 1px solid #e2e8f0;
        }

        .lesson-content th {
            background: #f8fafc;
            font-weight: 600;
            color: #0f172a;
        }

        /* Code Blocks */
        .lesson-content pre {
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%) !important;
            color: #e2e8f0 !important;
            border: 1px solid #000000 !important;
            border-radius: 0.75rem;
            padding: 1.5rem !important;
            margin: 1.5rem 0;
            overflow-x: auto;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .lesson-content p code,
        .lesson-content li code {
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%) !important;
            color: #ffffff !important;
            padding: 0.2rem 0.5rem !important;
            border-radius: 0.375rem !important;
            font-size: 0.875em !important;
        }

        /* Copy Button */
        .copy-button-wrapper {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            z-index: 10;
        }

        .copy-button {
            background: rgb(255, 255, 255);
            color: #000000;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .copy-button:hover {
            background: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
        }

        .copy-button.copied {
            background: #000000;
            color: rgb(255, 255, 255);
        }

        /* Completion Section - Inline Compact */
        .completion-section {
            max-width: 100%;
            margin: 2rem 0 0;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 0.75rem;
            border: 1px solid #93c5fd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s ease;
        }

        .completion-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .completion-section.completed {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            border-color: #86efac;
        }

        .completion-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .completion-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px -2px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .completion-icon svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .completion-section.completed .completion-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .completion-section.completed .completion-icon svg {
            color: white;
        }

        .completion-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .completion-section.completed .completion-title {
            color: #059669;
        }

        .complete-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px -2px rgba(0, 83, 197, 0.35);
            transition: all 0.2s ease;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .complete-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px -2px rgba(0, 83, 197, 0.45);
        }

        .complete-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .complete-button svg {
            width: 1rem;
            height: 1rem;
        }

        @media (max-width: 480px) {
            .completion-section {
                flex-direction: column;
                text-align: center;
                padding: 1rem;
            }

            .completion-left {
                justify-content: center;
            }
        }

        /* Sidebar */
        .learn-sidebar {
            position: sticky;
            top: 5rem;
            height: fit-content;
            max-height: calc(100vh - 10rem);
            overflow-y: auto;
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .learn-sidebar.collapsed {
            width: 0;
            padding: 0;
            opacity: 0;
            overflow: hidden;
            border: none;
        }

        .sidebar-toggle {
            position: absolute;
            left: 1rem;
            top: 1rem;
            width: 2.25rem;
            height: 2.25rem;
            background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            transform: scale(1.05);
        }

        .sidebar-toggle svg {
            width: 1.25rem;
            height: 1.25rem;
            transition: transform 0.3s ease;
        }

        .sidebar-toggle-float {
            position: fixed;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 83, 197, 0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .sidebar-toggle-float:hover {
            transform: translateY(-50%) scale(1.1);
        }

        .sidebar-toggle-float svg {
            width: 1.5rem;
            height: 1.5rem;
        }

        .sidebar-toggle-float.show {
            display: flex;
        }

        .sidebar-header {
            position: relative;
            padding-top: 3.5rem;
        }

        .sidebar-tabs {
            display: flex;
            padding: 0 1rem;
            padding-left: 3.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .sidebar-tab {
            flex: 1;
            padding: 1rem 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.8125rem;
            color: #94a3b8;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            transition: all 0.2s;
        }

        .sidebar-tab:hover {
            color: #475569;
        }

        .sidebar-tab.active {
            color: #0053C5;
            border-bottom-color: #0053C5;
        }

        .tab-content {
            display: none;
            padding: 1.25rem;
        }

        .tab-content.active {
            display: block;
        }

        /* Progress Bar */
        .progress-container {
            padding: 1.25rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .progress-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
        }

        .progress-value {
            font-size: 0.875rem;
            font-weight: 700;
            color: #059669;
        }

        .progress-bar {
            width: 100%;
            height: 0.5rem;
            background: #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
            border-radius: 1rem;
            transition: width 0.5s ease;
        }

        /* Module Accordion */
        .module-item {
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 0.25rem;
        }

        .module-item:last-child {
            border-bottom: none;
        }

        .module-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.875rem 0;
            font-weight: 600;
            font-size: 0.9375rem;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s;
        }

        .module-header:hover {
            color: #0053C5;
        }

        .module-header svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #94a3b8;
            transition: all 0.3s ease;
        }

        .module-header.open svg {
            transform: rotate(90deg);
            color: #0053C5;
        }

        .lesson-list {
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
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .lesson-item:hover {
            background: #f8fafc;
            color: #0053C5;
        }

        .lesson-item.active {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #0053C5;
            font-weight: 600;
            border-left: 3px solid #0053C5;
        }

        .lesson-item.completed {
            color: #059669;
        }

        .lesson-item.completed.active {
            color: #0053C5;
        }

        .lesson-item .checkmark {
            color: #10b981;
            width: 1.125rem;
            height: 1.125rem;
        }

        /* Notes & Discussion */
        .note-item {
            padding: 1rem;
            background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%);
            border: 1px solid #fde047;
            border-radius: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .note-item p {
            color: #1e293b;
            margin: 0;
            white-space: pre-wrap;
            font-size: 0.9375rem;
            line-height: 1.6;
        }

        .note-item .note-date {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 0.5rem;
        }

        .discussion-item {
            padding: 1rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s;
        }

        .discussion-item:hover {
            border-color: #0053C5;
            box-shadow: 0 4px 12px rgba(0, 83, 197, 0.1);
        }

        .discussion-title {
            font-size: 0.9375rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }

        .discussion-meta {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.5rem;
            gap: 0.5rem;
        }

        .discussion-content {
            font-size: 0.875rem;
            color: #475569;
            margin: 0 0 0.75rem 0;
            line-height: 1.5;
        }

        .discussion-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .discussion-replies {
            font-size: 0.75rem;
            color: #64748b;
        }

        .discussion-link {
            font-size: 0.75rem;
            color: #0053C5;
            font-weight: 600;
            text-decoration: none;
        }

        .discussion-link:hover {
            text-decoration: underline;
        }

        /* Forms */
        .form-card {
            padding: 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .form-card.note-form {
            background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%);
            border-color: #fde047;
        }

        .form-card.discussion-form {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #93c5fd;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            background: white;
            transition: all 0.2s;
            margin-bottom: 0.75rem;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #0053C5;
            box-shadow: 0 0 0 3px rgba(0, 83, 197, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-submit {
            padding: 0.625rem 1.25rem;
            background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 83, 197, 0.3);
        }

        .btn-cancel {
            padding: 0.625rem 1.25rem;
            background: white;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }

        .add-button {
            color: #0053C5;
            font-weight: 600;
            font-size: 0.875rem;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .add-button:hover {
            color: #003d91;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: #94a3b8;
            font-size: 0.875rem;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e2e8f0;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
            z-index: 40;
        }

        .bottom-nav-inner {
            max-width: 1600px;
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
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            color: #475569;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .nav-button:hover:not(.disabled) {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #0053C5;
            color: #0053C5;
            transform: translateY(-2px);
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

        .current-lesson-info {
            text-align: center;
        }

        .current-lesson-label {
            font-size: 0.6875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }

        .current-lesson-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.9375rem;
            margin-top: 0.125rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .learn-wrapper {
                grid-template-columns: 1fr;
                padding: 1rem;
                padding-bottom: 6rem;
            }

            .learn-sidebar {
                position: fixed;
                right: 0;
                top: 4rem;
                bottom: 0;
                width: 380px;
                max-width: 90vw;
                max-height: none;
                border-radius: 0;
                z-index: 45;
            }

            .learn-sidebar.collapsed {
                transform: translateX(100%);
                opacity: 1;
            }

            .lesson-header {
                padding: 1.5rem;
            }

            .lesson-title {
                font-size: 1.5rem;
            }

            .lesson-content-card {
                padding: 1.5rem;
            }

            .bottom-nav-inner {
                padding: 0.875rem 1rem;
                gap: 0.5rem;
            }

            .nav-button span {
                display: none;
            }

            .current-lesson-info {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .learn-nav-inner {
                padding: 0 1rem;
            }

            .course-info h1 {
                font-size: 0.875rem;
                max-width: 180px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .progress-badge span {
                display: none;
            }

            .lesson-title {
                font-size: 1.25rem;
            }

            .lesson-content {
                font-size: 1rem;
            }

            .completion-section {
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
                padding: 1.5rem;
            }

            .completion-title {
                font-size: 1.375rem;
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Floating Toggle Button -->
    <button class="sidebar-toggle-float" onclick="toggleSidebar()" id="sidebarToggleFloat">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Custom Top Navigation -->
    <nav class="learn-nav">
        <div class="learn-nav-inner">
            <div class="learn-nav-left">
                <a href="{{ route('courses.show', $course->slug) }}" class="back-button">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="course-info">
                    <h1>{{ $course->title }}</h1>
                    <p>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        {{ $currentLesson->module->title }}
                    </p>
                </div>
            </div>

            <div class="progress-badge">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $enrollment ? number_format($enrollment->progress_percentage, 0) : 0 }}% Selesai</span>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <div class="learn-wrapper" id="contentWrapper">
        <!-- Main Content Area -->
        <main class="learn-content">
            <!-- Video Player -->
            @if ($currentLesson->video_url)
                <div class="video-container">
                    <div id="player"></div>
                </div>
            @endif

            <!-- Lesson Header -->
            <div class="lesson-header">
                <h1 class="lesson-title">{{ $currentLesson->title }}</h1>
                <div class="lesson-meta">
                    <div class="lesson-meta-item primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                        {{ $currentLesson->module->title }}
                    </div>
                    @if ($currentLesson->video_url)
                        <div class="lesson-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Video Pembelajaran
                        </div>
                    @endif
                    @if ($userProgress && $userProgress->is_completed)
                        <div class="lesson-meta-item"
                            style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); color: #059669;">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Selesai
                        </div>
                    @endif
                </div>
            </div>

            <!-- Lesson Content -->
            <div class="lesson-content-card">
                <div id="lessonContent">
                    @if ($currentLesson->content)
                        <div class="lesson-content">
                            {!! $currentLesson->content !!}
                        </div>
                    @else
                        <div class="empty-state" style="padding: 3rem;">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p style="color: #64748b; font-style: italic;">Konten materi belum tersedia.</p>
                        </div>
                    @endif
                </div>

                <!-- Completion Section -->
                <div class="completion-section {{ $userProgress && $userProgress->is_completed ? 'completed visible' : '' }}"
                    id="completionSection">
                    @if ($userProgress && $userProgress->is_completed)
                        <div class="completion-left">
                            <div class="completion-icon">
                                <svg fill="white" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="completion-title">Materi Selesai! 🎉</h2>
                        </div>
                    @else
                        <div class="completion-left">
                            <div class="completion-icon">
                                <svg fill="#0053C5" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="completion-title">Selesai Membaca?</h2>
                        </div>
                        <button class="complete-button" onclick="markAsComplete()" id="completeButton">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tandai Selesai</span>
                        </button>
                    @endif
                </div>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="learn-sidebar" id="sidebar">
            <button class="sidebar-toggle" onclick="toggleSidebar()" id="sidebarToggle">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="sidebar-header">
                <div class="sidebar-tabs">
                    <div class="sidebar-tab active" onclick="switchTab('contents')">Daftar Isi</div>
                    <div class="sidebar-tab" onclick="switchTab('notes')">Catatan</div>
                    <div class="sidebar-tab" onclick="switchTab('discussions')">Diskusi</div>
                </div>
            </div>

            <!-- Contents Tab -->
            <div id="contents-tab" class="tab-content active">
                <div class="progress-container">
                    <div class="progress-header">
                        <span class="progress-label">Progres Kursus</span>
                        <span
                            class="progress-value">{{ $enrollment ? number_format($enrollment->progress_percentage, 0) : 0 }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill"
                            style="width: {{ $enrollment ? $enrollment->progress_percentage : 0 }}%;"></div>
                    </div>
                </div>

                @foreach ($course->modules as $index => $module)
                    @php
                        $hasActiveLesson = $module->lessons->contains('id', $currentLesson->id);
                    @endphp
                    <div class="module-item">
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
                                    class="lesson-item {{ $isActive ? 'active' : '' }} {{ $isCompleted ? 'completed' : '' }}">
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

            <!-- Notes Tab -->
            <div id="notes-tab" class="tab-content" x-data="{ showNoteForm: false }">
                <div class="section-header">
                    <h3 class="section-title">Catatan Saya</h3>
                    <button class="add-button" @click="showNoteForm = !showNoteForm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah
                    </button>
                </div>

                <div x-show="showNoteForm" x-transition class="form-card note-form" style="display: none;">
                    <form onsubmit="saveNote(event)">
                        <textarea id="noteInput" class="form-textarea" rows="3" placeholder="Tulis catatan Anda..." required></textarea>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Simpan</button>
                            <button type="button" class="btn-cancel" @click="showNoteForm = false">Batal</button>
                        </div>
                    </form>
                </div>

                <div id="notesList">
                    @forelse ($notes as $note)
                        <div class="note-item">
                            <p>{{ $note->note }}</p>
                            <p class="note-date">{{ optional($note->created_at)->diffForHumans() ?? 'Baru saja' }}</p>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada catatan.</div>
                    @endforelse
                </div>
            </div>

            <!-- Discussions Tab -->
            <div id="discussions-tab" class="tab-content" x-data="{ showDiscussionForm: false }">
                <div class="section-header">
                    <h3 class="section-title">Diskusi</h3>
                    <button class="add-button" @click="showDiscussionForm = !showDiscussionForm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat
                    </button>
                </div>

                <div x-show="showDiscussionForm" x-transition class="form-card discussion-form" style="display: none;">
                    <form method="POST" action="{{ route('forum.store') }}">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $currentLesson->id }}">
                        <input type="text" name="title" class="form-input" placeholder="Judul diskusi..." required>
                        <textarea name="content" class="form-textarea" rows="3" placeholder="Tulis pertanyaan atau topik diskusi..."
                            required></textarea>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Posting</button>
                            <button type="button" class="btn-cancel" @click="showDiscussionForm = false">Batal</button>
                        </div>
                    </form>
                </div>

                <div id="discussionsList">
                    @forelse ($discussions as $discussion)
                        <div class="discussion-item">
                            <h4 class="discussion-title">{{ $discussion->title }}</h4>
                            <div class="discussion-meta">
                                <span>{{ $discussion->user->name }}</span>
                                <span>•</span>
                                <span>{{ optional($discussion->created_at)->diffForHumans() ?? 'Baru saja' }}</span>
                            </div>
                            <p class="discussion-content">{{ Str::limit($discussion->content, 100) }}</p>
                            <div class="discussion-footer">
                                <span class="discussion-replies">💬 {{ $discussion->replies_count }} balasan</span>
                                <a href="{{ route('forum.show', $discussion) }}" class="discussion-link">Lihat →</a>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada diskusi untuk materi ini.</div>
                    @endforelse
                </div>

                @if ($discussions->count() > 0)
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="{{ route('forum.index') }}?course_id={{ $course->id }}" class="discussion-link">
                            Lihat Semua Diskusi →
                        </a>
                    </div>
                @endif
            </div>
        </aside>
    </div>

    <!-- Bottom Navigation -->
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

    <nav class="bottom-nav">
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

            <div class="current-lesson-info">
                <div class="current-lesson-label">Sedang Dipelajari</div>
                <div class="current-lesson-title">{{ Str::limit($currentLesson->title, 30) }}</div>
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
    </nav>
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

            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollPercent = (scrollTop / (documentHeight - windowHeight)) * 100;

            scrollProgress.style.width = scrollPercent + '%';

            if (scrollPercent >= 80 && !completionSection.classList.contains('visible')) {
                completionSection.classList.add('visible');
            }
        });

        // Sidebar Toggle
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

        // Module Toggle
        function toggleModule(moduleId) {
            const moduleList = document.getElementById('module-' + moduleId);
            const moduleHeader = event.currentTarget;
            const isOpen = moduleList.classList.contains('open');

            if (isOpen) {
                moduleList.classList.remove('open');
                moduleHeader.classList.remove('open');
            } else {
                moduleList.classList.add('open');
                moduleHeader.classList.add('open');
            }
        }

        // Update Progress
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

        // Mark as Complete
        function markAsComplete() {
            const button = document.getElementById('completeButton');
            button.disabled = true;
            button.innerHTML =
                '<svg style="width: 24px; height: 24px; animation: spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg><span>Menyimpan...</span>';

            let reloadTriggered = false;

            const fallbackTimer = setTimeout(() => {
                if (!reloadTriggered) {
                    reloadTriggered = true;
                    forceReload();
                }
            }, 3000);

            function forceReload() {
                button.innerHTML =
                    '<svg style="width: 24px; height: 24px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg><span>Berhasil!</span>';

                setTimeout(() => {
                    const currentUrl = window.location.href.split('?')[0].split('#')[0];
                    window.location.href = currentUrl + '?_t=' + Date.now();

                    setTimeout(() => {
                        window.location.reload(true);
                    }, 500);
                }, 500);
            }

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
                    clearTimeout(fallbackTimer);
                    if (!reloadTriggered) {
                        reloadTriggered = true;
                        forceReload();
                    }
                    return response.text();
                })
                .catch(error => {
                    clearTimeout(fallbackTimer);
                    if (!reloadTriggered) {
                        reloadTriggered = true;
                        forceReload();
                    }
                });
        }

        // Save Note
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
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        // Switch Tab
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

        // Code Block Enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const lessonContent = document.querySelector('.lesson-content');
            if (!lessonContent) return;

            lessonContent.querySelectorAll('pre').forEach(block => {
                if (block.querySelector('.copy-button')) return;

                const code = block.querySelector('code') || block;
                const text = code.textContent || code.innerText;

                const wrapper = document.createElement('div');
                wrapper.className = 'copy-button-wrapper';

                const button = document.createElement('button');
                button.className = 'copy-button';
                button.innerHTML =
                    '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                button.onclick = async function() {
                    try {
                        await navigator.clipboard.writeText(text);
                        button.innerHTML =
                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg> Copied!';
                        button.classList.add('copied');
                        setTimeout(() => {
                            button.innerHTML =
                                '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>';
                            button.classList.remove('copied');
                        }, 2000);
                    } catch (e) {
                        console.error('Copy failed:', e);
                    }
                };

                wrapper.appendChild(button);
                block.style.position = 'relative';
                block.appendChild(wrapper);

                block.addEventListener('scroll', function() {
                    const scrollLeft = block.scrollLeft;
                    wrapper.style.transform = 'translateX(' + scrollLeft + 'px)';
                });
            });
        });
    </script>
@endpush
