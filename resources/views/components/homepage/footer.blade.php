<footer class="bg-gradient-to-b from-white to-gray-50 mt-20 border-t border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8 mb-8">

            <!-- Brand Section -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <div class="flex flex-col sm:flex-row items-center md:items-start gap-3 mb-3">
                    <h2 class="text-base font-bold text-gray-800 leading-tight">
                        Sistem Manajemen<br>Organisasi
                    </h2>
                </div>
                <p class="text-sm text-gray-600">
                    Wadah kolaborasi untuk mengembangkan potensi anggota
                </p>
            </div>

            <!-- Quick Links -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h3 class="text-sm font-bold text-gray-800 mb-3">Menu</h3>
                <nav>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="{{ route('home') }}" class="hover:text-purple-600 transition">Beranda</a></li>
                        <li><a href="#event" class="hover:text-purple-600 transition">Event</a></li>
                        <li><a href="#pengumuman" class="hover:text-purple-600 transition">Pengumuman</a></li>
                        <li><a href="#galeri" class="hover:text-purple-600 transition">Galeri</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Contact Info -->
            <div id="kontak" class="flex flex-col items-center md:items-start text-center md:text-left">
                <h3 class="text-sm font-bold text-gray-800 mb-3">Kontak</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li
                        class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 justify-center md:justify-start">
                        <i class="fas fa-phone w-4 text-purple-600"></i>
                        <span>(081) 777777</span>
                    </li>
                    <li
                        class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 justify-center md:justify-start">
                        <i class="fas fa-envelope w-4 text-purple-600"></i>
                        <span>intech@gmail.com</span>
                    </li>
                    <li
                        class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 justify-center md:justify-start">
                        <i class="fas fa-map-marker-alt w-4 text-purple-600"></i>
                        <span>Jl. Haji Ridho 1, Bandung</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="pt-6 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-500">
                © 2025 Sistem Manajemen Organisasi. All Rights Reserved.
            </p>
        </div>

    </div>
</footer>