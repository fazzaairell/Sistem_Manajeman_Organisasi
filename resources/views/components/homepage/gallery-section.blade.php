<div id="galeri" class="relative flex justify-center items-center mt-20 mb-20">
    <div class="w-[70%] space-y-2">
        <h2 class="text-purple-800 text-2xl font-semibold">Koleksi terbaru</h2>
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold">📰 • Galeri KAMI</h1>
            <p class="text-blue-800"><a href="#">Lihat semua →</a></p>
        </div>

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mt-10">
            @forelse($galleries as $gallery)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                        class="w-full h-48 object-cover rounded-2xl shadow-md transition-transform duration-300 group-hover:scale-105" />
                    <div class="absolute bottom-3 left-3 bg-black bg-opacity-40 text-white px-2 py-1 rounded-md text-sm">
                        {{ $gallery->title }}
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-gray-500 text-center">Belum ada foto.</p>
            @endforelse
        </div>
    </div>
</div>