@extends('layouts.admin')

@section('title', 'Buat Kursus Baru')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Back Button & Header -->
        <div class="mb-8">
            <a href="{{ route('admin.courses.index') }}"
                class="inline-flex items-center text-sm text-dark-500 hover:text-primary-500 transition-colors mb-4 group">
                <svg class="w-4 h-4 mr-1.5 transition-transform group-hover:-translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Kursus
            </a>
            <h1 class="text-2xl font-bold text-dark-800">Buat Kursus Baru</h1>
            <p class="mt-1 text-sm text-dark-500">Isi informasi dasar kursus. Anda dapat menambahkan modul dan materi
                setelah kursus dibuat.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-primary-500 to-primary-600">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-white">Informasi Kursus</h2>
                        <p class="text-sm text-primary-100">Lengkapi form di bawah ini</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data"
                class="p-6 space-y-6" id="courseForm">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-dark-700 mb-2">
                        Judul Kursus <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        placeholder="Contoh: Belajar Laravel dari Dasar"
                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-dark-700 placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 focus:bg-white transition-all @error('title') border-red-300 bg-red-50 @enderror">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-dark-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description"
                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-dark-700 placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 focus:bg-white transition-all @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    <p id="description-error" class="mt-2 text-sm text-red-600 hidden flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Deskripsi wajib diisi.
                    </p>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Level -->
                <div>
                    <label for="level" class="block text-sm font-semibold text-dark-700 mb-2">
                        Level <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="level" id="level" required
                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-dark-700 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 focus:bg-white transition-all appearance-none @error('level') border-red-300 @enderror">
                            <option value="">Pilih Level</option>
                            <option value="beginner" {{ old('level') === 'beginner' ? 'selected' : '' }}>🟢 Beginner - Untuk
                                pemula</option>
                            <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>🟡
                                Intermediate - Tingkat menengah</option>
                            <option value="advanced" {{ old('level') === 'advanced' ? 'selected' : '' }}>🔴 Advanced -
                                Tingkat lanjut</option>
                        </select>
                        <svg class="w-5 h-5 text-dark-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    @error('level')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div>
                    <label for="thumbnail" class="block text-sm font-semibold text-dark-700 mb-2">
                        Thumbnail
                    </label>
                    <div class="relative">
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="hidden"
                            onchange="previewThumbnail(this)">

                        <!-- Upload Area -->
                        <label for="thumbnail"
                            class="flex flex-col items-center justify-center w-full h-48 px-4 border-2 border-dashed border-slate-300 rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-primary-400 transition-all group"
                            id="uploadArea">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadPlaceholder">
                                <div
                                    class="w-14 h-14 mb-3 rounded-xl bg-primary-100 flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                    <svg class="w-7 h-7 text-primary-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="mb-1 text-sm text-dark-600 font-medium">
                                    <span class="text-primary-500">Klik untuk upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-dark-400">PNG, JPG atau JPEG (Maks. 2MB)</p>
                            </div>

                            <!-- Preview -->
                            <div id="thumbnailPreview" class="hidden w-full h-full">
                                <img src="" alt="Preview" class="w-full h-full object-cover rounded-lg">
                            </div>
                        </label>
                    </div>
                    @error('thumbnail')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div
                    class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-6 border-t border-slate-200">
                    <a href="{{ route('admin.courses.index') }}"
                        class="w-full sm:w-auto px-6 py-3 text-center border border-slate-300 rounded-xl text-dark-600 font-medium hover:bg-slate-50 hover:border-slate-400 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25 hover:shadow-xl hover:shadow-primary-500/30 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Buat Kursus
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Card -->
        <div class="mt-6 bg-primary-50 rounded-2xl border border-primary-100 p-5">
            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-dark-700 mb-1">Tips membuat kursus yang baik</h3>
                    <ul class="text-sm text-dark-600 space-y-1">
                        <li>• Gunakan judul yang jelas dan deskriptif</li>
                        <li>• Tulis deskripsi yang menjelaskan apa yang akan dipelajari</li>
                        <li>• Pilih level yang sesuai dengan target peserta</li>
                        <li>• Gunakan thumbnail yang menarik dan relevan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- TinyMCE Component --}}
    <x-admin.tinymce id="description" :height="300" />

    {{-- Scripts --}}
    @push('scripts')
        <script>
            // Thumbnail Preview
            function previewThumbnail(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('uploadPlaceholder').classList.add('hidden');
                        document.getElementById('thumbnailPreview').classList.remove('hidden');
                        document.querySelector('#thumbnailPreview img').src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Form Validation
            document.getElementById('courseForm').addEventListener('submit', function(e) {
                tinymce.triggerSave();

                const content = tinymce.get('description').getContent();
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = content;
                const textContent = tempDiv.textContent || tempDiv.innerText || '';

                if (!content || textContent.trim() === '') {
                    e.preventDefault();
                    document.getElementById('description-error').classList.remove('hidden');
                    document.getElementById('description').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    tinymce.get('description').focus();
                    return false;
                }

                document.getElementById('description-error').classList.add('hidden');
            });
        </script>
    @endpush
@endsection
