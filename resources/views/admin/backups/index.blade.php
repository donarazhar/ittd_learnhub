@extends('layouts.admin')

@section('title', 'Database & Files Backup')

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
            <span class="text-gray-900 font-medium">Backup Management</span>
        </nav>

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    Database & Files Backup
                </h1>
                <p class="mt-2 text-sm text-gray-600">Kelola backup database dan files aplikasi secara aman</p>
            </div>

            <!-- Create Backup Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center px-6 py-3 bg-[#0053C5] border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-[#003d91] shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Backup Baru
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-64 rounded-xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-10 overflow-hidden"
                    style="display: none;">
                    <div class="py-2">
                        <form action="{{ route('admin.backups.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="full">
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 flex items-center transition group">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center mr-3 shadow-md group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Full Backup</div>
                                    <div class="text-xs text-gray-500">Database + Files</div>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('admin.backups.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="db">
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-green-50 flex items-center transition group">
                                <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mr-3 shadow-md group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Database Only</div>
                                    <div class="text-xs text-gray-500">MySQL/PostgreSQL</div>
                                </div>
                            </button>
                        </form>
                        <form action="{{ route('admin.backups.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="files">
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 flex items-center transition group">
                                <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center mr-3 shadow-md group-hover:scale-110 transition">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">Files Only</div>
                                    <div class="text-xs text-gray-500">Application Files</div>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#0053C5] p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Total Backups</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $statistics['total_count'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $statistics['total_size'] }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Full Backup</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $statistics['full_backup_count'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">DB + Files</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-purple-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Database</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $statistics['db_only_count'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">DB Only</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-orange-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Latest Backup</p>
                    <p class="text-sm font-bold text-gray-900">{{ $statistics['latest_backup'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $statistics['average_size'] }} avg</p>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup Status Cards -->
    @if (!empty($backupStatuses))
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            @foreach ($backupStatuses as $status)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden border-l-4 {{ $status['healthy'] ? 'border-green-500' : 'border-red-500' }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-bold {{ $status['healthy'] ? 'text-green-700' : 'text-red-700' }} flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        @if($status['healthy'])
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        @else
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        @endif
                                    </svg>
                                    {{ $status['name'] }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                    </svg>
                                    Disk: {{ $status['disk'] }}
                                </p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold shadow-sm {{ $status['healthy'] ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                {{ $status['healthy'] ? 'Healthy' : 'Unhealthy' }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Backups</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $status['amount'] }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Newest</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $status['newest'] ?? 'N/A' }}</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Storage</p>
                                <p class="text-lg font-bold text-[#0053C5]">{{ $status['used_storage'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Backup Files List -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                Backup Files ({{ count($backups) }})
            </h3>
            <div class="flex gap-2">
                <button onclick="location.reload()"
                    class="inline-flex items-center px-4 py-2 bg-white border-2 border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-[#0053C5] transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh
                </button>
                <form action="{{ route('admin.backups.clean') }}" method="POST" 
                    onsubmit="return confirm('Yakin ingin membersihkan backup lama sesuai retention policy?')">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-yellow-700 shadow-md hover:shadow-lg transition-all">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Cleanup
                    </button>
                </form>
            </div>
        </div>

        @if (count($backups) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">File Name</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Size</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Age</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($backups as $backup)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-[#0053C5] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $backup['name'] }}</p>
                                            <p class="text-xs text-gray-500 font-mono">{{ Str::limit($backup['name'], 40) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $typeBadge = match($backup['type']) {
                                            'Full Backup' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200'],
                                            'Database Only' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200'],
                                            'Files Only' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-200'],
                                            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-200']
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $typeBadge['bg'] }} {{ $typeBadge['text'] }} border {{ $typeBadge['border'] }}">
                                        {{ $backup['type'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-900">{{ $backup['size'] }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs">
                                        <p class="text-gray-900 font-semibold">{{ $backup['date_formatted'] }}</p>
                                        <p class="text-gray-500">{{ $backup['date_human'] }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-xs text-gray-600">{{ $backup['age_days'] }} hari</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.backups.download', basename($backup['path'])) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-[#0053C5] hover:bg-blue-200 rounded-lg text-xs font-semibold transition-all">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            Download
                                        </a>
                                        <form action="{{ route('admin.backups.destroy', basename($backup['path'])) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus backup ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-xs font-semibold transition-all">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada backup</h3>
                <p class="text-sm text-gray-600 mb-6">Mulai membuat backup untuk mengamankan data Anda</p>
            </div>
        @endif
    </div>

    <!-- Schedule Information -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Jadwal Backup Otomatis
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($scheduleInfo as $schedule)
                    <div class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="flex-shrink-0">
                            <div class="p-3 bg-{{ $schedule['color'] }}-100 rounded-lg shadow-md">
                                <svg class="w-8 h-8 text-{{ $schedule['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($schedule['icon'] === 'database')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                    @elseif($schedule['icon'] === 'server')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                                    @elseif($schedule['icon'] === 'trash')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-base font-bold text-gray-900">{{ $schedule['name'] }}</h4>
                            <p class="text-sm text-gray-700 mt-1 font-semibold">{{ $schedule['schedule'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $schedule['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Retention Policy -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="bg-blue-50 border-l-4 border-[#0053C5] rounded-r-lg p-5">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-[#0053C5] mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-[#0053C5] mb-3">Retention Policy:</h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Semua backup disimpan selama <strong>7 hari</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Backup harian disimpan selama <strong>16 hari</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Backup mingguan disimpan selama <strong>8 minggu</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Backup bulanan disimpan selama <strong>4 bulan</strong></span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Backup tahunan disimpan selama <strong>2 tahun</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection