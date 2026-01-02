
@extends('layouts.guest')

@section('title', 'Register Pegawai Baru')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-primary-50 via-white to-primary-50">
    <div class="max-w-2xl w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Registrasi Pegawai Baru</h1>
            <p class="text-gray-600">Lengkapi data pegawai untuk membuat akun</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Employee ID -->
                    <div>
                        <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">
                            NIP/ID Pegawai <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="employee_id"
                            type="text"
                            name="employee_id"
                            value="{{ old('employee_id') }}"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select
                            id="role"
                            name="role"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <option value="">Pilih Role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pegawai)</option>
                            <option value="kontributor" {{ old('role') == 'kontributor' ? 'selected' : '' }}>Kontributor</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 
                              hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-3 bg-gradient-primary text-white font-semibold 
                               rounded-lg hover:opacity-90 transition">
                        Daftar Pegawai
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection