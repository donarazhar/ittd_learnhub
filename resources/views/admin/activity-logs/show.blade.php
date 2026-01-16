@extends('layouts.admin')

@section('title', 'Activity Log Detail')

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
            <a href="{{ route('admin.activity-logs.index') }}" class="hover:text-[#0053C5] transition">
                Activity Logs
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-medium">Log #{{ $activity->id }}</span>
        </nav>

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('admin.activity-logs.index') }}"
                    class="inline-flex items-center text-sm text-gray-600 hover:text-[#0053C5] mb-3 transition group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Activity Logs
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Activity Log Detail
                </h1>
                <p class="mt-2 text-sm text-gray-600">Detail informasi activity log #{{ $activity->id }}</p>
            </div>

            <!-- Log ID Badge -->
            <div class="bg-gradient-to-br from-[#0053C5] to-[#003d91] text-white px-6 py-3 rounded-xl shadow-lg">
                <div class="text-xs opacity-90 mb-1">Log ID</div>
                <div class="text-2xl font-bold">#{{ $activity->id }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Dasar
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start border-b border-gray-100 pb-4">
                        <div class="flex-shrink-0 w-40">
                            <p class="text-sm font-bold text-gray-700">ID</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-mono bg-gray-50 px-3 py-1 rounded inline-block">
                                #{{ $activity->id }}</p>
                        </div>
                    </div>

                    <div class="flex items-start border-b border-gray-100 pb-4">
                        <div class="flex-shrink-0 w-40">
                            <p class="text-sm font-bold text-gray-700">Deskripsi</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 leading-relaxed">{{ $activity->description }}</p>
                        </div>
                    </div>

                    <div class="flex items-start border-b border-gray-100 pb-4">
                        <div class="flex-shrink-0 w-40">
                            <p class="text-sm font-bold text-gray-700">Log Name</p>
                        </div>
                        <div class="flex-1">
                            <span
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $activity->log_name }}
                            </span>
                        </div>
                    </div>

                    @if ($activity->event)
                        <div class="flex items-start border-b border-gray-100 pb-4">
                            <div class="flex-shrink-0 w-40">
                                <p class="text-sm font-bold text-gray-700">Event</p>
                            </div>
                            <div class="flex-1">
                                @php
                                    $eventConfig = match ($activity->event) {
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
                                <span
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $eventConfig['bg'] }} {{ $eventConfig['text'] }} border {{ $eventConfig['border'] }}">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $eventConfig['icon'] }}" />
                                    </svg>
                                    {{ ucfirst($activity->event) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-40">
                            <p class="text-sm font-bold text-gray-700">Waktu</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-semibold">
                                {{ $activity->created_at->format('d F Y, H:i:s') }}</p>
                            <p class="text-xs text-gray-500 mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $activity->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject Info Card -->
            @if ($activity->subject_type)
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Subject Information
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start border-b border-gray-100 pb-4">
                            <div class="flex-shrink-0 w-40">
                                <p class="text-sm font-bold text-gray-700">Type</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-semibold">
                                    {{ class_basename($activity->subject_type) }}</p>
                                <p class="text-xs text-gray-500 font-mono mt-1 bg-gray-50 px-2 py-1 rounded inline-block">
                                    {{ $activity->subject_type }}</p>
                            </div>
                        </div>

                        <div class="flex items-start border-b border-gray-100 pb-4">
                            <div class="flex-shrink-0 w-40">
                                <p class="text-sm font-bold text-gray-700">ID</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-mono bg-gray-50 px-3 py-1 rounded inline-block">
                                    #{{ $activity->subject_id }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-40">
                                <p class="text-sm font-bold text-gray-700">Status</p>
                            </div>
                            <div class="flex-1">
                                @if ($activity->subject)
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Exists
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Deleted
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Properties Card -->
            @if ($activity->properties && $activity->properties->isNotEmpty())
                <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                            </svg>
                            Properties & Changes
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-xl p-5 overflow-x-auto shadow-inner">
                            <pre class="text-xs text-green-400 font-mono leading-relaxed">{{ json_encode($activity->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Causer Info Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        User Information
                    </h3>
                </div>
                <div class="p-6">
                    @if ($activity->causer)
                        <div class="text-center">
                            <div
                                class="w-24 h-24 rounded-full bg-gradient-to-br from-[#0053C5] to-[#003d91] text-white flex items-center justify-center mx-auto mb-4 text-3xl font-bold shadow-lg">
                                {{ substr($activity->causer->name, 0, 1) }}
                            </div>

                            <h4 class="text-lg font-bold text-gray-900">{{ $activity->causer->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $activity->causer->email }}
                            </p>

                            @if ($activity->causer->role)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#0053C5] text-white mt-3 shadow-md">
                                    {{ ucfirst($activity->causer->role) }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-xs font-semibold text-gray-600">User ID</span>
                                <span class="text-sm text-gray-900 font-mono">#{{ $activity->causer->id }}</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <span class="text-xs font-semibold text-gray-600">Type</span>
                                <span class="text-sm text-gray-900">{{ class_basename($activity->causer_type) }}</span>
                            </div>
                        </div>

                        @if (Route::has('admin.users.show'))
                            <div class="mt-6">
                                <a href="{{ route('admin.users.show', $activity->causer) }}"
                                    class="block w-full text-center px-4 py-3 bg-[#0053C5] text-white font-semibold rounded-lg hover:bg-[#003d91] shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                                    Lihat Profile
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="font-semibold text-gray-900">System Action</p>
                            <p class="text-xs text-gray-500 mt-1">No user associated</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Quick Actions
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    @if ($activity->causer)
                        <a href="{{ route('admin.activity-logs.index', ['user_id' => $activity->causer_id]) }}"
                            class="block w-full text-center px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all text-sm shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            User's Activities
                        </a>
                    @endif

                    @if ($activity->log_name)
                        <a href="{{ route('admin.activity-logs.index', ['log_name' => $activity->log_name]) }}"
                            class="block w-full text-center px-4 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all text-sm shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Similar Logs
                        </a>
                    @endif

                    @if ($activity->event)
                        <a href="{{ route('admin.activity-logs.index', ['event' => $activity->event]) }}"
                            class="block w-full text-center px-4 py-2.5 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-all text-sm shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ ucfirst($activity->event) }} Events
                        </a>
                    @endif
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="bg-white shadow-lg rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0053C5]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Metadata
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 mb-1">Created At</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $activity->created_at->format('d F Y, H:i:s') }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 mb-1">Updated At</p>
                        <p class="text-sm text-gray-900 font-medium">{{ $activity->updated_at->format('d F Y, H:i:s') }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs font-semibold text-gray-600 mb-1">Time Ago</p>
                        <p class="text-sm text-gray-900 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1 text-[#0053C5]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                    @if ($activity->batch_uuid)
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs font-semibold text-gray-600 mb-1">Batch UUID</p>
                            <p class="text-xs text-gray-900 font-mono break-all leading-relaxed">
                                {{ $activity->batch_uuid }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
