{{-- resources/views/profile/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="bg-white py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between"
                x-data="{ show: true }" x-show="show" x-transition>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-green-700">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Profile Header -->
            <div class="flex items-center mb-8 pb-8 border-b border-gray-200">
                <div
                    class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="ml-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="px-2 py-1 bg-primary-100 text-primary-800 rounded-full text-xs font-semibold">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Update Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', auth()->user()->email) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-300 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Employee ID (Read Only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            NIP/ID Pegawai
                        </label>
                        <input type="text" value="{{ auth()->user()->employee_id }}" disabled
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
                        <p class="mt-1 text-xs text-gray-500">NIP tidak dapat diubah</p>
                    </div>

                    <!-- Role (Read Only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Role
                        </label>
                        <input type="text" value="{{ ucfirst(auth()->user()->role) }}" disabled
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
                    </div>
                </div>

                <hr class="my-8">

                <!-- Change Password Section -->
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ubah Password</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Saat Ini
                        </label>
                        <input type="password" name="current_password" id="current_password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('current_password') border-red-300 @enderror">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div></div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru
                        </label>
                        <input type="password" name="password" id="password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>

                <p class="text-sm text-gray-600">
                    <strong>Catatan:</strong> Kosongkan bagian password jika tidak ingin mengubah password.
                </p>

                <!-- Submit Button -->
                <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
