@extends('layouts.admin')

@section('title', 'Kelola Kursus')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-dark-800">Kelola Kursus</h1>
                <p class="mt-1 text-sm text-dark-500">Kelola semua kursus yang tersedia di platform</p>
            </div>
            <a href="{{ route('admin.courses.create') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25 hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Kursus Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <!-- Total Courses -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-primary-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-dark-500 truncate">Total Kursus</p>
                    <p class="text-2xl font-bold text-dark-800">{{ $courses->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Published -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-dark-500 truncate">Published</p>
                    <p class="text-2xl font-bold text-dark-800">{{ $courses->where('status', 'published')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Draft -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-dark-500 truncate">Draft</p>
                    <p class="text-2xl font-bold text-dark-800">{{ $courses->where('status', 'draft')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Enrolled -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/60 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-violet-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-dark-500 truncate">Total Peserta</p>
                    <p class="text-2xl font-bold text-dark-800">{{ $courses->sum('total_enrolled') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <!-- Table Header (for filters/search - optional) -->
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="font-semibold text-dark-700">Daftar Kursus</h3>
                <div class="flex items-center gap-3">
                    <!-- Search (Optional) -->
                    <div class="relative">
                        <input type="text" placeholder="Cari kursus..."
                            class="w-full sm:w-64 pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500">
                        <svg class="w-5 h-5 text-dark-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-dark-500 uppercase tracking-wider">
                            Kursus
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-dark-500 uppercase tracking-wider">
                            Status & Statistik
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-dark-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($courses as $course)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- Course Info -->
                            <td class="px-6 py-5">
                                <div class="flex items-start gap-4">
                                    <!-- Thumbnail -->
                                    @if ($course->thumbnail)
                                        <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                            class="w-20 h-14 rounded-xl object-cover flex-shrink-0 ring-1 ring-slate-200">
                                    @else
                                        <div
                                            class="w-20 h-14 rounded-xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-dark-800 mb-1 line-clamp-1">
                                            {{ $course->title }}
                                        </h3>
                                        <p class="text-sm text-dark-500 mb-2 line-clamp-2">
                                            {{ Str::limit(strip_tags($course->description), 80) }}
                                        </p>

                                        <!-- Meta Info -->
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-dark-400">
                                            <!-- Level Badge -->
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-lg font-medium
                                                {{ $course->level === 'beginner' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                {{ $course->level === 'intermediate' ? 'bg-amber-100 text-amber-700' : '' }}
                                                {{ $course->level === 'advanced' ? 'bg-rose-100 text-rose-700' : '' }}">
                                                {{ ucfirst($course->level) }}
                                            </span>

                                            <!-- Modules Count -->
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                                {{ $course->modules->count() }} Modul
                                            </span>

                                            <!-- Lessons Count -->
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                {{ $course->modules->flatMap->lessons->count() }} Materi
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Status & Stats -->
                            <td class="px-6 py-5">
                                <div class="flex flex-col items-center gap-3">
                                    <!-- Status Badge -->
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                        {{ $course->status === 'published' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $course->status === 'draft' ? 'bg-slate-100 text-slate-600' : '' }}
                                        {{ $course->status === 'archived' ? 'bg-red-100 text-red-700' : '' }}">
                                        @if ($course->status === 'published')
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        @elseif($course->status === 'draft')
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span>
                                        @else
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                        @endif
                                        {{ ucfirst($course->status) }}
                                    </span>

                                    <!-- Enrolled Count -->
                                    <div class="text-center">
                                        <p class="text-2xl font-bold text-dark-800">{{ $course->total_enrolled ?? 0 }}</p>
                                        <p class="text-xs text-dark-400">Peserta</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('admin.courses.edit', $course) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl border border-slate-200 text-dark-600 bg-white hover:bg-slate-50 hover:border-primary-300 hover:text-primary-600 transition-all">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>

                                    <!-- Publish/Unpublish -->
                                    @if ($course->status === 'draft')
                                        <form method="POST" action="{{ route('admin.courses.publish', $course) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl border border-emerald-200 text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition-all">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="hidden sm:inline">Publish</span>
                                            </button>
                                        </form>
                                    @elseif($course->status === 'published')
                                        <form method="POST" action="{{ route('admin.courses.unpublish', $course) }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl border border-amber-200 text-amber-700 bg-amber-50 hover:bg-amber-100 transition-all">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                                <span class="hidden sm:inline">Unpublish</span>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                        class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus kursus ini? Semua modul dan materi akan terhapus!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-xl border border-red-200 text-red-600 bg-red-50 hover:bg-red-100 transition-all">
                                            <svg class="w-4 h-4 sm:mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="hidden sm:inline">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty State -->
                        <tr>
                            <td colspan="3" class="px-6 py-16">
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-dark-700 mb-1">Belum ada kursus</h3>
                                    <p class="text-sm text-dark-500 mb-6">Mulai dengan membuat kursus pertama Anda.</p>
                                    <a href="{{ route('admin.courses.create') }}"
                                        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold rounded-xl hover:from-primary-600 hover:to-primary-700 transition-all shadow-lg shadow-primary-500/25">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Buat Kursus Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($courses->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
@endsection
