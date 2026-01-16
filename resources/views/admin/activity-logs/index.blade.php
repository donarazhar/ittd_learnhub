@extends('layouts.admin')

@section('title', 'Activity Logs')

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
            <span class="text-gray-900 font-medium">Activity Logs</span>
        </nav>

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Activity Logs
                </h1>
                <p class="mt-2 text-sm text-gray-600">Monitor semua aktivitas dan perubahan data dalam sistem</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-2">
                <button type="button" onclick="document.getElementById('filterModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2.5 bg-white border-2 border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:border-[#0053C5] hover:text-[#0053C5] transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter
                </button>
                <form action="{{ route('admin.activity-logs.export') }}" method="GET" class="inline">
                    @foreach (request()->all() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2.5 bg-green-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-green-700 shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Export CSV
                    </button>
                </form>
                <button type="button" onclick="document.getElementById('cleanModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2.5 bg-red-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-red-700 shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Clean Logs
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#0053C5] p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Total Logs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($activities->total()) }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ number_format(\Spatie\Activitylog\Models\Activity::whereDate('created_at', today())->count()) }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-blue-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Minggu Ini</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ number_format(\Spatie\Activitylog\Models\Activity::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()) }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border-l-4 border-yellow-500 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-1">Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ number_format(\Spatie\Activitylog\Models\Activity::whereMonth('created_at', now()->month)->count()) }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Filters -->
    @if (request()->hasAny(['log_name', 'event', 'user_id', 'date_from', 'date_to', 'search']))
        <div class="mb-6 bg-blue-50 border-l-4 border-[#0053C5] rounded-r-lg p-4" x-data="{ show: true }" x-show="show"
            x-transition>
            <div class="flex items-start">
                <svg class="w-5 h-5 text-[#0053C5] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-semibold text-[#0053C5] mb-2">Filter Aktif:</p>
                    <div class="flex flex-wrap gap-2">
                        @if (request('log_name'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                Log: {{ request('log_name') }}
                            </span>
                        @endif
                        @if (request('event'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                Event: {{ request('event') }}
                            </span>
                        @endif
                        @if (request('user_id'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                User ID: {{ request('user_id') }}
                            </span>
                        @endif
                        @if (request('date_from'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                Dari: {{ request('date_from') }}
                            </span>
                        @endif
                        @if (request('date_to'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                Sampai: {{ request('date_to') }}
                            </span>
                        @endif
                        @if (request('search'))
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white border border-blue-200 text-[#0053C5]">
                                Search: "{{ request('search') }}"
                            </span>
                        @endif
                        <a href="{{ route('admin.activity-logs.index') }}"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 hover:bg-red-200 transition">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear All
                        </a>
                    </div>
                </div>
                <button @click="show = false" class="ml-auto flex-shrink-0 text-blue-400 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Activities Table -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Event
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Time
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($activities as $activity)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-xs font-mono text-gray-900 font-semibold">#{{ $activity->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($activity->causer)
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] flex items-center justify-center text-white font-bold text-sm shadow-md">
                                            {{ substr($activity->causer->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-gray-900">{{ $activity->causer->name }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $activity->causer->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-semibold text-gray-500">System</p>
                                            <p class="text-xs text-gray-400">Auto</p>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="space-y-1">
                                    @php
                                        $eventBadge = match ($activity->event ?? 'default') {
                                            'created' => [
                                                'bg' => 'bg-green-100',
                                                'text' => 'text-green-800',
                                                'border' => 'border-green-200',
                                                'icon' => 'M12 4v16m8-8H4',
                                            ],
                                            'updated' => [
                                                'bg' => 'bg-blue-100',
                                                'text' => 'text-blue-800',
                                                'border' => 'border-blue-200',
                                                'icon' =>
                                                    'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                                            ],
                                            'deleted' => [
                                                'bg' => 'bg-red-100',
                                                'text' => 'text-red-800',
                                                'border' => 'border-red-200',
                                                'icon' =>
                                                    'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                                            ],
                                            default => [
                                                'bg' => 'bg-gray-100',
                                                'text' => 'text-gray-800',
                                                'border' => 'border-gray-200',
                                                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                            ],
                                        };
                                    @endphp
                                    @if ($activity->event)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $eventBadge['bg'] }} {{ $eventBadge['text'] }} border {{ $eventBadge['border'] }}">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ $eventBadge['icon'] }}" />
                                            </svg>
                                            {{ ucfirst($activity->event) }}
                                        </span>
                                    @endif
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 border border-purple-200">
                                        {{ $activity->log_name }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900 font-medium">{{ Str::limit($activity->description, 50) }}
                                </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($activity->subject_type)
                                    <div class="text-xs">
                                        <p class="font-semibold text-gray-900">
                                            {{ class_basename($activity->subject_type) }}</p>
                                        <p class="text-gray-500 font-mono">#{{ $activity->subject_id }}</p>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs">
                                    <p class="text-gray-900 font-medium">{{ $activity->created_at->format('d M Y') }}</p>
                                    <p class="text-gray-500">{{ $activity->created_at->format('H:i:s') }}</p>
                                    <p class="text-gray-400 text-[10px]">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.activity-logs.show', $activity) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-[#0053C5] hover:bg-blue-200 rounded-lg text-xs font-semibold transition-all">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Tidak ada activity log</h3>
                                    <p class="text-sm text-gray-600">Belum ada aktivitas yang tercatat dalam sistem</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($activities->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75"
                onclick="document.getElementById('filterModal').classList.add('hidden')"></div>

            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-xl">
                <form method="GET" action="{{ route('admin.activity-logs.index') }}">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Logs
                        </h3>
                        <button type="button" onclick="document.getElementById('filterModal').classList.add('hidden')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Log Name</label>
                            <select name="log_name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition">
                                <option value="">Semua Log</option>
                                @foreach ($logNames as $logName)
                                    <option value="{{ $logName }}"
                                        {{ request('log_name') === $logName ? 'selected' : '' }}>
                                        {{ $logName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Event</label>
                            <select name="event"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition">
                                <option value="">Semua Event</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event }}"
                                        {{ request('event') === $event ? 'selected' : '' }}>
                                        {{ ucfirst($event) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                            <input type="date" name="date_from"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition"
                                value="{{ request('date_from') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                            <input type="date" name="date_to"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition"
                                value="{{ request('date_to') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                            <input type="text" name="search"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition"
                                placeholder="Cari dalam deskripsi..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="document.getElementById('filterModal').classList.add('hidden')"
                            class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition-all">
                            Batal
                        </button>
                        <a href="{{ route('admin.activity-logs.index') }}"
                            class="flex-1 px-4 py-3 bg-white border-2 border-red-300 text-red-700 rounded-lg hover:bg-red-50 font-semibold transition-all text-center">
                            Reset
                        </a>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-[#0053C5] text-white rounded-lg hover:bg-[#003d91] font-semibold transition-all">
                            Apply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Clean Modal -->
    <div id="cleanModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75"
                onclick="document.getElementById('cleanModal').classList.add('hidden')"></div>

            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-xl">
                <form method="POST" action="{{ route('admin.activity-logs.clean') }}">
                    @csrf
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Clean Old Logs
                        </h3>
                        <button type="button" onclick="document.getElementById('cleanModal').classList.add('hidden')"
                            class="text-gray-400 hover:text-gray-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <p class="text-sm text-gray-700 font-medium">Hapus activity logs yang lebih lama dari:</p>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Hari</label>
                            <input type="number" name="days"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0053C5] focus:border-[#0053C5] transition"
                                value="365" min="1" required>
                        </div>

                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.589 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="text-sm">
                                    <p class="font-bold text-red-800 mb-1">Perhatian!</p>
                                    <p class="text-red-700">Aksi ini akan menghapus data secara permanen dan tidak dapat
                                        dibatalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="button" onclick="document.getElementById('cleanModal').classList.add('hidden')"
                            class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition-all">
                            Hapus Logs
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
