<!-- resources/views/components/frontend/footer.blade.php -->

<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="p-2 bg-gradient-primary rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-bold">IT Learning Hub</span>
                </div>
                <p class="text-gray-400 text-sm">
                    Platform pembelajaran internal untuk meningkatkan kompetensi pegawai IT di YPI Al-Azhar.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider mb-4">Menu</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm">Beranda</a></li>
                    <li><a href="{{ route('courses.index') }}" class="text-gray-400 hover:text-white text-sm">Kursus</a>
                    </li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm">Dashboard</a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Divisi IT</li>
                    <li>YPI Al-Azhar</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} YPI Al-Azhar. All rights reserved.
            </p>
        </div>
    </div>
</footer>
