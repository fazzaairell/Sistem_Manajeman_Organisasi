<div id="galeri" class="relative flex justify-center items-center mt-20 mb-20">
    <div class="w-[70%] space-y-2">
        <h2 class="text-purple-800 text-2xl font-semibold">Koleksi Terbaru</h2>
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">Galeri Kami</h1>
            <p class="text-blue-800"><a href="#">Lihat semua →</a></p>
        </div>

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mt-10">
            @forelse($galleries as $gallery)
                <div class="relative group overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300">
                    @if($gallery->image)
                        <img src="{{ filter_var($gallery->image, FILTER_VALIDATE_URL) ? $gallery->image : asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->title }}"
                             class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110" />
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                            <i class="fas fa-image text-gray-300 text-5xl"></i>
                        </div>
                    @endif
                    
                    <!-- Overlay gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                    
                    <!-- Title overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-white font-bold text-lg drop-shadow-lg">{{ $gallery->title }}</h3>
                    </div>
                </div>
            @empty
                <div class="col-span-3 flex flex-col items-center justify-center py-16 text-gray-400">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-images text-3xl"></i>
                    </div>
                    <p class="font-medium">Belum ada foto di galeri</p>
                    <p class="text-sm mt-1">Galeri akan segera diperbarui</p>
                </div>
            @endforelse
        </div>
    </div>
</div>