
@extends('layouts.admin')

@section('title', 'Edit Kursus')

@push('styles')
    <style>
        /* Step Wizard Styling */
        .step-wizard {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-wizard::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            z-index: 0;
        }

        .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 2px solid #e5e7eb;
            color: #9ca3af;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin: 0 auto;
            cursor: pointer;
            transition: all 0.3s;
        }

        .step-item.active .step-button {
            background: #0053C5;
            border-color: #0053C5;
            color: white;
        }

        .step-item.completed .step-button {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        .step-label {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
        }

        .step-item.active .step-label {
            color: #0053C5;
            font-weight: 600;
        }

        .step-item.completed .step-label {
            color: #10b981;
        }

        /* Step Content */
        .step-content {
            display: none;
            animation: fadeIn 0.3s;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Navigation Buttons */
        .step-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Drag and Drop Styles */
        .lesson-item {
            transition: all 0.3s ease;
        }

        .lesson-item.dragging {
            opacity: 0.5;
            cursor: grabbing !important;
        }

        .lesson-item.drag-over {
            border-color: #0053C5 !important;
            background-color: #eff6ff !important;
            transform: scale(1.02);
        }

        .drag-handle {
            cursor: grab;
            touch-action: none;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .sortable-ghost {
            opacity: 0.4;
            background: #f3f4f6;
        }

        .sortable-chosen {
            cursor: grabbing;
        }
    </style>
@endpush

@section('content')
    <div x-data="courseWizard()">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <a href="{{ route('admin.courses.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Kursus
                </a>
                <h1 class="text-2xl font-bold text-dark-700">Edit Kursus: {{ $course->title }}</h1>
            </div>
            <div class="flex items-center space-x-3">
                @if ($course->status === 'draft')
                    <form method="POST" action="{{ route('admin.courses.publish', $course) }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Publish Kursus
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.courses.unpublish', $course) }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            Unpublish
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Step Wizard -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Steps Header -->
            <div class="step-wizard">
                <div class="step-item" :class="{ 'active': currentStep === 1, 'completed': currentStep > 1 }">
                    <button type="button" class="step-button" @click="goToStep(1)">
                        <span x-show="currentStep <= 1">1</span>
                        <svg x-show="currentStep > 1" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="step-label">Informasi Kursus</div>
                </div>

                <div class="step-item" :class="{ 'active': currentStep === 2, 'completed': currentStep > 2 }">
                    <button type="button" class="step-button" @click="goToStep(2)">
                        <span x-show="currentStep <= 2">2</span>
                        <svg x-show="currentStep > 2" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="step-label">Kelola Modul</div>
                </div>

                <div class="step-item" :class="{ 'active': currentStep === 3 }">
                    <button type="button" class="step-button" @click="goToStep(3)">3</button>
                    <div class="step-label">Kelola Materi</div>
                </div>
            </div>

            <!-- Step 1: Course Information -->
            <div class="step-content" :class="{ 'active': currentStep === 1 }">
                <h2 class="text-xl font-bold text-dark-700 mb-6">Informasi Kursus</h2>

                <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data"
                    class="space-y-4" id="courseEditForm">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-dark-700 mb-2">Judul Kursus <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $course->title) }}" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-dark-700 mb-2">Level <span
                                    class="text-red-500">*</span></label>
                            <select name="level" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="beginner" {{ $course->level === 'beginner' ? 'selected' : '' }}>Beginner
                                </option>
                                <option value="intermediate" {{ $course->level === 'intermediate' ? 'selected' : '' }}>
                                    Intermediate</option>
                                <option value="advanced" {{ $course->level === 'advanced' ? 'selected' : '' }}>Advanced
                                </option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="course_description" class="block text-sm font-medium text-dark-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="course_description"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description', $course->description) }}</textarea>
                        <p id="course-description-error" class="mt-1 text-sm text-red-600 hidden">Deskripsi wajib diisi.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-700 mb-2">Thumbnail</label>
                        @if ($course->thumbnail)
                            <div class="mb-2">
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="Current thumbnail"
                                    class="h-32 w-auto rounded border">
                                <p class="text-xs text-gray-500 mt-1">Thumbnail saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="thumbnail" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="mt-1 text-sm text-gray-500">Upload gambar baru untuk mengganti thumbnail</p>
                    </div>

                    <div class="step-navigation">
                        <div></div>
                        <div class="flex space-x-3">
                            <button type="submit"
                                class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                                Simpan & Lanjut
                            </button>
                            <button type="button" @click="nextStep()"
                                class="px-6 py-2 border border-primary-500 text-primary-500 rounded-lg hover:bg-primary-50 transition">
                                Lanjut ke Modul →
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Step 2: Modules -->
            <div class="step-content" :class="{ 'active': currentStep === 2 }">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-dark-700">Kelola Modul Kursus</h2>
                    <button @click="showAddModuleForm = true"
                        class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                        + Tambah Modul
                    </button>
                </div>

                <!-- Add Module Form -->
                <div x-show="showAddModuleForm" x-transition
                    class="mb-6 p-4 bg-primary-50 rounded-lg border border-primary-100" style="display: none;">
                    <h3 class="font-semibold text-dark-700 mb-4">Tambah Modul Baru</h3>
                    <form method="POST" action="{{ route('admin.modules.store', $course) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-dark-700 mb-2">Judul Modul <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        </div>
                        <div>
                            <label for="module_description" class="block text-sm font-medium text-dark-700 mb-2">Deskripsi
                                (Opsional)</label>
                            <textarea name="description" id="module_description" rows="3"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"></textarea>
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600">Simpan
                                Modul</button>
                            <button type="button" @click="showAddModuleForm = false"
                                class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</button>
                        </div>
                    </form>
                </div>

                <!-- Modules List -->
                @if ($course->modules->count() > 0)
                    <div class="space-y-3">
                        @foreach ($course->modules as $index => $module)
                            <div class="border border-gray-200 rounded-lg hover:border-primary-300 transition">
                                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary-500 text-white flex items-center justify-center font-semibold text-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-dark-700">{{ $module->title }}</h3>
                                            @if ($module->description)
                                                <p class="text-sm text-dark-400 mt-1">{{ $module->description }}</p>
                                            @endif
                                            <span class="text-xs text-dark-400 mt-1 inline-block">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                {{ $module->lessons->count() }} materi
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button type="button" @click="selectedModule = {{ $module->id }}; goToStep(3)"
                                            class="px-3 py-1.5 text-sm bg-primary-500 text-white rounded hover:bg-primary-600">
                                            Kelola Materi
                                        </button>
                                        <form method="POST" action="{{ route('admin.modules.destroy', $module) }}"
                                            class="inline" onsubmit="return confirm('Yakin hapus modul ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <p class="mt-2 text-gray-500">Belum ada modul. Klik "Tambah Modul" untuk membuat modul pertama.</p>
                    </div>
                @endif

                <div class="step-navigation">
                    <button type="button" @click="prevStep()"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        ← Kembali
                    </button>
                    <button type="button" @click="nextStep()"
                        class="px-6 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                        Lanjut ke Materi →
                    </button>
                </div>
            </div>

            <!-- Step 3: Lessons -->
            <div class="step-content" :class="{ 'active': currentStep === 3 }">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-dark-700">Kelola Materi Pembelajaran</h2>
                    <p class="text-sm text-dark-400 mt-1">Pilih modul untuk mengelola materi di dalamnya</p>
                </div>

                <!-- Module Selector -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-dark-700 mb-2">Pilih Modul</label>
                    <select x-model="selectedModule" @change="loadModuleLessons()"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-dark-700 font-medium bg-white shadow-sm">
                        <option value="">-- Pilih Modul --</option>
                        @foreach ($course->modules as $module)
                            <option value="{{ $module->id }}">{{ $module->title }} ({{ $module->lessons->count() }}
                                materi)</option>
                        @endforeach
                    </select>
                </div>

                <div x-show="selectedModule">
                    @foreach ($course->modules as $module)
                        <div x-show="selectedModule == {{ $module->id }}" class="space-y-4">
                            <div
                                class="flex items-center justify-between mb-6 p-4 bg-gradient-to-r from-primary-50 to-primary-100 rounded-lg border border-primary-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg bg-primary-500 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-dark-700 text-lg">{{ $module->title }}</h3>
                                        <p class="text-sm text-dark-500">{{ $module->lessons->count() }} materi
                                            pembelajaran</p>
                                    </div>
                                </div>
                                <button @click="showAddLessonForm = !showAddLessonForm"
                                    class="inline-flex items-center px-5 py-2.5 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Tambah Materi
                                </button>
                            </div>

                            <!-- Add Lesson Form -->
                            <div x-show="showAddLessonForm" x-transition
                                class="p-6 bg-gradient-to-br from-primary-50 to-white rounded-lg border-2 border-primary-200 shadow-sm"
                                style="display: none;">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 rounded-lg bg-primary-500 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-bold text-dark-700 text-lg">Tambah Materi Baru</h4>
                                </div>
                                <form method="POST" action="{{ route('admin.lessons.store', $module) }}"
                                    class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-semibold text-dark-700 mb-2">
                                            Judul Materi <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="title" required
                                            placeholder="Contoh: Pengenalan PHP Dasar"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-dark-700 mb-2">
                                            Video URL (YouTube)
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <input type="url" name="video_url"
                                                placeholder="https://youtube.com/watch?v=..."
                                                class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                                        </div>
                                        <p class="mt-1 text-xs text-dark-400">Opsional: Tambahkan link video YouTube untuk
                                            materi ini</p>
                                    </div>
                                    <div class="flex space-x-3 pt-2">
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Simpan Materi
                                        </button>
                                        <button type="button" @click="showAddLessonForm = false"
                                            class="inline-flex items-center px-6 py-3 border-2 border-gray-300 text-dark-600 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Lessons List with Drag & Drop -->
                            @if ($module->lessons->count() > 0)
                                <div id="sortable-lessons-{{ $module->id }}" class="space-y-3"
                                    data-module-id="{{ $module->id }}">
                                    @foreach ($module->lessons as $index => $lesson)
                                        <div class="lesson-item group border-2 border-gray-200 rounded-lg p-5 hover:border-primary-300 hover:shadow-md transition-all bg-white"
                                            data-lesson-id="{{ $lesson->id }}">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4 flex-1">
                                                    <!-- Drag Handle -->
                                                    <div
                                                        class="drag-handle flex-shrink-0 text-gray-400 hover:text-primary-500 transition-colors">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 8h16M4 16h16" />
                                                        </svg>
                                                    </div>

                                                    <div
                                                        class="w-10 h-10 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center flex-shrink-0">
                                                        <span
                                                            class="text-smfont-bold text-dark-600">{{ $index + 1 }}</span>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        @if ($lesson->video_url)
                                                            <div
                                                                class="w-12 h-12 rounded-lg bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-sm">
                                                                <svg class="w-6 h-6 text-white" fill="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div
                                                                class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                                                <svg class="w-6 h-6 text-white" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="flex-1">
                                                        <h4
                                                            class="text-dark-700 font-semibold text-base group-hover:text-primary-600 transition-colors">
                                                            {{ $lesson->title }}
                                                        </h4>
                                                        <div class="flex items-center space-x-3 mt-1">
                                                            @if ($lesson->video_url)
                                                                <span
                                                                    class="inline-flex items-center text-xs text-red-600 font-medium">
                                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path
                                                                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                                    </svg>
                                                                    Video
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="inline-flex items-center text-xs text-blue-600 font-medium">
                                                                    <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Dokumen
                                                                </span>
                                                            @endif
                                                            <span class="text-xs text-dark-400">Materi
                                                                #{{ $index + 1 }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-2 ml-4">
                                                    <a href="{{ route('admin.lessons.edit', $lesson) }}"
                                                        class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-primary-600 bg-primary-50 rounded-lg hover:bg-primary-100 transition-all transform hover:scale-105">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Kelola
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.lessons.destroy', $lesson) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Yakin hapus materi ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-all transform hover:scale-105">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
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
                            @else
                                <div
                                    class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                                    <div
                                        class="w-20 h-20 mx-auto bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-dark-600 mb-2">Belum Ada Materi</h3>
                                    <p class="text-sm text-dark-400 mb-6">Klik tombol "Tambah Materi" untuk menambahkan
                                        materi pembelajaran pertama</p>
                                    <button @click="showAddLessonForm = true"
                                        class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Tambah Materi Pertama
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="step-navigation">
                    <button type="button" @click="prevStep()"
                        class="inline-flex items-center px-6 py-3 border-2 border-gray-300 text-dark-600 font-semibold rounded-lg hover:bg-gray-50 transition-all transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </button>
                    <a href="{{ route('admin.courses.index') }}"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-bold rounded-lg hover:from-green-700 hover:to-green-800 transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Selesai & Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TinyMCE Component for Course Description --}}
    <x-admin.tinymce id="course_description" :height="300" />

    {{-- Scripts --}}
    @push('scripts')
        <!-- SortableJS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

        <script>
            // Course wizard Alpine component
            function courseWizard() {
                return {
                    currentStep: {{ session('current_step', 1) }},
                    showAddModuleForm: false,
                    showAddLessonForm: false,
                    selectedModule: '{{ session('selected_module', '') }}',

                    init() {
                        // Log untuk debug
                        console.log('Initial step:', this.currentStep);
                        console.log('Initial selected module:', this.selectedModule);
                        
                        // Re-initialize Sortable setelah load
                        this.$nextTick(() => {
                            initializeSortable();
                        });
                    },

                    goToStep(step) {
                        this.currentStep = step;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    },

                    nextStep() {
                        if (this.currentStep < 3) {
                            this.currentStep++;
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                        }
                    },

                    prevStep() {
                        if (this.currentStep > 1) {
                            this.currentStep--;
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                        }
                    },

                    loadModuleLessons() {
                        this.showAddLessonForm = false;

                        // Re-initialize Sortable after module change
                        this.$nextTick(() => {
                            initializeSortable();
                        });
                    }
                }
            }

            // Initialize Sortable for each module
            function initializeSortable() {
                document.querySelectorAll('[id^="sortable-lessons-"]').forEach(function(el) {
                    // Destroy existing sortable instance if any
                    if (el.sortable) {
                        el.sortable.destroy();
                    }

                    const moduleId = el.dataset.moduleId;

                    el.sortable = new Sortable(el, {
                        animation: 150,
                        handle: '.drag-handle',
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        dragClass: 'dragging',

                        onEnd: function(evt) {
                            // Get all lesson IDs in new order
                            const lessonIds = [];
                            el.querySelectorAll('.lesson-item').forEach(function(item, index) {
                                lessonIds.push({
                                    id: item.dataset.lessonId,
                                    order: index + 1
                                });

                                // Update the displayed number
                                const numberSpan = item.querySelector('.w-10.h-10 span');
                                if (numberSpan) {
                                    numberSpan.textContent = index + 1;
                                }
                            });

                            // Send AJAX request to update order
                            fetch(`/admin/modules/${moduleId}/lessons/reorder`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        lessons: lessonIds
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Show success notification (optional)
                                        console.log('Order updated successfully');
                                    } else {
                                        alert('Gagal mengupdate urutan materi');
                                        location.reload();
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Terjadi kesalahan saat mengupdate urutan');
                                    location.reload();
                                });
                        }
                    });
                });
            }

            // Form validation for course description (TinyMCE)
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('courseEditForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Sync TinyMCE content to textarea
                        if (typeof tinymce !== 'undefined' && tinymce.get('course_description')) {
                            tinymce.triggerSave();

                            // Get TinyMCE content
                            const content = tinymce.get('course_description').getContent();

                            // Check if empty
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = content;
                            const textContent = tempDiv.textContent || tempDiv.innerText || '';

                            if (!content || textContent.trim() === '') {
                                e.preventDefault();

                                // Show error message
                                document.getElementById('course-description-error').classList.remove('hidden');

                                // Scroll to error
                                document.getElementById('course_description').scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });

                                // Focus TinyMCE
                                tinymce.get('course_description').focus();

                                return false;
                            }

                            // Hide error if validation passes
                            document.getElementById('course-description-error').classList.add('hidden');
                        }
                    });
                }

                // Initialize Sortable on page load
                setTimeout(() => {
                    initializeSortable();
                }, 500);
            });
        </script>
    @endpush
@endsection