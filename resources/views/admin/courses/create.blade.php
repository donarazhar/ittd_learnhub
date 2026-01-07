@extends('layouts.admin')

@section('title', 'Buat Kursus Baru')

@section('content')
    <div class="max-w-3xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Buat Kursus Baru</h1>
            <p class="mt-1 text-sm text-gray-600">Isi informasi dasar kursus. Anda dapat menambahkan modul dan materi setelah
                kursus dibuat.</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="space-y-6"
                id="courseForm">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Kursus <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('title') border-red-300 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description with TinyMCE (NO REQUIRED!) -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    <p id="description-error" class="mt-1 text-sm text-red-600 hidden">Deskripsi wajib diisi.</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Level -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                        Level <span class="text-red-500">*</span>
                    </label>
                    <select name="level" id="level" required
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('level') border-red-300 @enderror">
                        <option value="">Pilih Level</option>
                        <option value="beginner" {{ old('level') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('level') === 'intermediate' ? 'selected' : '' }}>Intermediate
                        </option>
                        <option value="advanced" {{ old('level') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                        Thumbnail
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 @error('thumbnail') border-red-300 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Ukuran maksimal 2MB. Format: JPG, PNG</p>
                    @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4 border-t">
                    <a href="{{ route('admin.courses.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition">
                        Buat Kursus
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- TinyMCE Component --}}
    <x-admin.tinymce id="description" :height="300" />

    {{-- Form Validation Script --}}
    @push('scripts')
        <script>
            document.getElementById('courseForm').addEventListener('submit', function(e) {
                // Sync TinyMCE content to textarea
                tinymce.triggerSave();

                // Get TinyMCE content
                const content = tinymce.get('description').getContent();

                // Check if empty (also check for empty tags like <p><br></p>)
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = content;
                const textContent = tempDiv.textContent || tempDiv.innerText || '';

                if (!content || textContent.trim() === '') {
                    e.preventDefault();

                    // Show error message
                    document.getElementById('description-error').classList.remove('hidden');

                    // Scroll to error
                    document.getElementById('description').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Focus TinyMCE
                    tinymce.get('description').focus();

                    return false;
                }

                // Hide error if validation passes
                document.getElementById('description-error').classList.add('hidden');
            });
        </script>
    @endpush
@endsection
