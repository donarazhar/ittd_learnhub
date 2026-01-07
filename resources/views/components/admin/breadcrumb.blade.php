<!-- resources/views/components/admin/breadcrumb.blade.php -->

<nav class="bg-white border-b border-gray-200 px-4 py-3 sm:px-6 lg:px-8" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm">
        <!-- Home / Dashboard -->
        <li class="flex items-center">
            <a href="{{ route('admin.dashboard') }}"
                class="text-gray-500 hover:text-primary-600 transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Breadcrumb Items -->
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                <!-- Separator -->
                <svg class="w-5 h-5 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>

                @if ($loop->last)
                    <!-- Last item (current page) -->
                    <span class="font-medium text-dark-700" aria-current="page">
                        {{ $item['label'] }}
                    </span>
                @else
                    <!-- Linked items -->
                    <a href="{{ $item['url'] }}"
                        class="text-gray-500 hover:text-primary-600 transition-colors duration-200">
                        {{ $item['label'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
