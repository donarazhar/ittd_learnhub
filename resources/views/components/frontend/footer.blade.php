<!-- resources/views/components/frontend/footer.blade.php -->

<footer class="bg-gray-900 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="p-2 bg-gradient-primary rounded-lg">
                        <img src="{{ asset('img/logo-putih.png') }}" alt="IT Learning Hub" class="h-12 w-auto">
                    </div>
                    <span class="ml-3 text-xl font-bold text-white">ITTD Learning Hub</span>
                </div>
                <p class="text-sm text-gray-400 mb-4">
                    Platform pembelajaran internal untuk meningkatkan kompetensi dan skill pegawai IT YPI Al Azhar.
                </p>
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} YPI Al Azhar. All rights reserved.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-semibold mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-sm hover:text-white transition">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('courses.index') }}" class="text-sm hover:text-white transition">Kursus</a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('dashboard') }}" class="text-sm hover:text-white transition">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('my-courses') }}" class="text-sm hover:text-white transition">Kursus Saya</a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>ittd@al-azhar.or.id</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-2 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>YPI Al-Azhar<br>Jakarta, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm text-gray-500">
            <p>Dikembangkan oleh Bagian ITTD YPI Al Azhar</p>
        </div>
    </div>
</footer>
