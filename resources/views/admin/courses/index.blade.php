
@extends('layouts.admin')

@section('title', 'Kelola Kursus')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-gray-900">Kelola Kursus</h1>
    <a href="{{ route('admin.courses.create') }}"
        class="inline-flex items-center px-4 py-2 bg-gradient-primary text-white font-semibold rounded-lg hover:opacity-90 transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Buat Kursus Baru
    </a>
</div>

<!-- Table -->
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kursus
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pembuat
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Level
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Enrolled
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($courses as $course)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($course->thumbnail)
                            <img src="{{ Storage::url($course->thumbnail) }}"
                                alt="{{ $course->title }}"
                                class="h-10 w-10 rounded object-cover">
                            @else
                            <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($course->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $course->creator->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $course->level === 'beginner' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $course->level === 'intermediate' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $course->level === 'advanced' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($course->level) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $course->status === 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $course->status === 'archived' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($course->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $course->total_enrolled }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.courses.edit', $course) }}"
                                class="text-primary-600 hover:text-primary-900">
                                Edit
                            </a>
                            @if($course->status === 'draft')
                            <form method="POST" action="{{ route('admin.courses.publish', $course) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900">
                                    Publish
                                </button>
                            </form>
                            @elseif($course->status === 'published')
                            <form method="POST" action="{{ route('admin.courses.unpublish', $course) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                    Unpublish
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        Belum ada kursus. <a href="{{ route('admin.courses.create') }}" class="text-primary-600 hover:text-primary-900">Buat kursus pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($courses->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $courses->links() }}
    </div>
    @endif
</div>
@endsection