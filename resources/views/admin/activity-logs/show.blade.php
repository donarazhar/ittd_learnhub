@extends('layouts.admin')

@section('title', 'Activity Log Detail')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Activity Log Detail</h1>
                <p class="text-gray-600 mt-1">Detail informasi activity log</p>
            </div>
            <a href="{{ route('admin.activity-logs.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-32">
                            <p class="text-sm font-medium text-gray-500">ID</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 font-mono">#{{ $activity->id }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-32">
                            <p class="text-sm font-medium text-gray-500">Deskripsi</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ $activity->description }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-32">
                            <p class="text-sm font-medium text-gray-500">Log Name</p>
                        </div>
                        <div class="flex-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $activity->log_name }}
                            </span>
                        </div>
                    </div>

                    @if($activity->event)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-32">
                                <p class="text-sm font-medium text-gray-500">Event</p>
                            </div>
                            <div class="flex-1">
                                @php
                                    $badgeClass = match($activity->event) {
                                        'created' => 'bg-green-100 text-green-800',
                                        'updated' => 'bg-blue-100 text-blue-800',
                                        'deleted' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                    {{ $activity->event }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-32">
                            <p class="text-sm font-medium text-gray-500">Waktu</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ $activity->created_at->format('d F Y, H:i:s') }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject Info Card -->
            @if($activity->subject_type)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Subject Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-32">
                                <p class="text-sm font-medium text-gray-500">Type</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-mono">{{ class_basename($activity->subject_type) }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $activity->subject_type }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-32">
                                <p class="text-sm font-medium text-gray-500">ID</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-mono">#{{ $activity->subject_id }}</p>
                            </div>
                        </div>

                        @if($activity->subject)
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-32">
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                </div>
                                <div class="flex-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Exists
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-32">
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                </div>
                                <div class="flex-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Deleted
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Properties Card -->
            @if($activity->properties->isNotEmpty())
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Properties</h3>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
                            <pre class="text-xs text-green-400 font-mono">{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Causer Info Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">User Information</h3>
                </div>
                <div class="p-6">
                    @if($activity->causer)
                        <div class="text-center">
                            @if($activity->causer->avatar)
                                <img src="{{ $activity->causer->avatar }}" 
                                    class="w-20 h-20 rounded-full mx-auto mb-4" 
                                    alt="{{ $activity->causer->name }}">
                            @else
                                <div class="w-20 h-20 rounded-full bg-primary-600 text-white flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                                    {{ substr($activity->causer->name, 0, 1) }}
                                </div>
                            @endif
                            
                            <h4 class="text-lg font-semibold text-gray-900">{{ $activity->causer->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $activity->causer->email }}</p>
                            
                            @if($activity->causer->role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800 mt-2">
                                    {{ ucfirst($activity->causer->role) }}
                                </span>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-xs font-medium text-gray-500">User ID</dt>
                                    <dd class="text-sm text-gray-900 font-mono mt-1">#{{ $activity->causer->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-gray-500">Causer Type</dt>
                                    <dd class="text-sm text-gray-900 mt-1">{{ class_basename($activity->causer_type) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('admin.users.show', $activity->causer) }}" 
                                class="block w-full text-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                                Lihat Profile
                            </a>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">System Action</p>
                            <p class="text-xs text-gray-500 mt-1">No user associated</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-2">
                    @if($activity->causer)
                        <a href="{{ route('admin.activity-logs.index', ['user_id' => $activity->causer_id]) }}" 
                            class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            View User's Activities
                        </a>
                    @endif

                    @if($activity->log_name)
                        <a href="{{ route('admin.activity-logs.index', ['log_name' => $activity->log_name]) }}" 
                            class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            View Similar Logs
                        </a>
                    @endif

                    @if($activity->event)
                        <a href="{{ route('admin.activity-logs.index', ['event' => $activity->event]) }}" 
                            class="block w-full text-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            View {{ ucfirst($activity->event) }} Events
                        </a>
                    @endif
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Metadata</h3>
                </div>
                <div class="p-6">
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-xs font-medium text-gray-500">Created At</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $activity->created_at->format('d F Y, H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500">Updated At</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $activity->updated_at->format('d F Y, H:i:s') }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500">Time Ago</dt>
                            <dd class="text-sm text-gray-900 mt-1">{{ $activity->created_at->diffForHumans() }}</dd>
                        </div>
                        @if($activity->batch_uuid)
                            <div>
                                <dt class="text-xs font-medium text-gray-500">Batch UUID</dt>
                                <dd class="text-xs text-gray-900 mt-1 font-mono break-all">{{ $activity->batch_uuid }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection