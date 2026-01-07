@extends('layouts.admin')

@section('title', 'Kelola Kursus')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Kursus</h1>
        <p class="mt-1 text-sm text-gray-600">Kelola semua kursus yang tersedia di platform</p>
    </div>
    <a href="{{ route('admin.courses.create') }}"
        class="inline-flex items-center px-4 py-2 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition shadow-sm">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Buat Kursus Baru
    </a>
</div>

<!-- Stats Cards (Optional) -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                <p class="text-2xl font-bold text-gray-900">{{ $courses->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Published</p>
                <p class="text-2xl font-bold text-gray-900">{{ $courses->where('status', 'published')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-yellow-100 rounded-lg p-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Draft</p>
                <p class="text-2xl font-bold text-gray-900">{{ $courses->where('status', 'draft')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Enrolled</p>
                <p class="text-2xl font-bold text-gray-900">{{ $courses->sum('total_enrolled') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Modern Table with Stacked Columns -->
<div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kursus
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status & Stats
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($courses as $course)
                <tr class="hover:bg-gray-50 transition">
                    {{-- Kolom 1: Course Info (Stacked) --}}
                    <td class="px-6 py-4">
                        <div class="flex items-start space-x-4">
                            {{-- Thumbnail --}}
                            @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}"
                                alt="{{ $course->title }}"
                                class="h-16 w-16 rounded-lg object-cover flex-shrink-0 ring-2 ring-gray-100">
                            @else
                            <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center flex-shrink-0">
                                <svg class="h-8 w-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            @endif
                            
                            {{-- Info Stack --}}
                            <div class="flex-1 min-w-0">
                                {{-- Title --}}
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">
                                    {{ $course->title }}
                                </h3>
                                
                                {{-- Description --}}
                                <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                    {{ Str::limit(strip_tags($course->description), 100) }}
                                </p>
                                
                                {{-- Meta Info --}}
                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                                    {{-- Creator --}}
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $course->creator->name }}
                                    </div>
                                    
                                    {{-- Level Badge --}}
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ $course->level === 'beginner' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $course->level === 'intermediate' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $course->level === 'advanced' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                    
                                    {{-- Modules Count --}}
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        {{ $course->modules->count() }} Modul
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    {{-- Kolom 2: Status & Stats (Stacked Center) --}}
                    <td class="px-6 py-4 text-center">
                        <div class="space-y-3">
                            {{-- Status Badge --}}
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $course->status === 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $course->status === 'archived' ? 'bg-red-100 text-red-800' : '' }}">
                                    @if($course->status === 'published')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                    {{ ucfirst($course->status) }}
                                </span>
                            </div>
                            
                            {{-- Enrolled Stats --}}
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $course->total_enrolled ?? 0 }}</div>
                                <div class="text-xs text-gray-500">Peserta Terdaftar</div>
                            </div>
                        </div>
                    </td>
                    
                    {{-- Kolom 3: Action Buttons (Modern) --}}
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            {{-- Edit Button --}}
                            <a href="{{ route('admin.courses.edit', $course) }}"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            
                            {{-- Publish/Unpublish Button --}}
                            @if($course->status === 'draft')
                            <form method="POST" action="{{ route('admin.courses.publish', $course) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 border border-green-300 shadow-sm text-sm font-medium rounded-lg text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Publish
                                </button>
                            </form>
                            @elseif($course->status === 'published')
                            <form method="POST" action="{{ route('admin.courses.unpublish', $course) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 border border-yellow-300 shadow-sm text-sm font-medium rounded-lg text-yellow-700 bg-yellow-50 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                    Unpublish
                                </button>
                            </form>
                            @endif
                            
                            {{-- Delete Button --}}
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus kursus ini? Semua modul dan materi akan terhapus!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- Empty State --}}
                <tr>
                    <td colspan="3" class="px-6 py-12">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kursus</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat kursus pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.courses.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Buat Kursus Pertama
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($courses->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $courses->links() }}
    </div>
    @endif
</div>
@endsection