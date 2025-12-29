<x-homepage.layout>

    <div id="pengumuman" class="relative flex justify-center items-center mt-20">
        <div class="w-[70%] space-y-2">
            <div class="mb-[60px]">
                <h2 class="text-3xl font-bold text-purple-950">Pengumuman</h2>
                <p class="text-gray-600 mt-2">Berikut adalah pengumuman terbaru kami</p>
            </div>


            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="grid gap-6 md:grid-cols-3">
                    @forelse($announcements as $announcement)
                        <div x-data="{ open: false }"
                            class="relative rounded-lg overflow-hidden shadow-lg group cursor-pointer">

                            <img src="{{ $announcement->image ? asset('storage/' . $announcement->image) : asset('images/default-announcement.png') }}"
                                alt="{{ $announcement->content }}"
                                class="w-full h-[30rem] object-cover brightness-75 transition duration-300 group-hover:brightness-90"
                                @click="open = true" />

                            <div
                                class="absolute top-3 left-3 bg-black bg-opacity-40 text-white text-xs font-semibold rounded-md px-2 py-1 border border-white">
                                INFO
                            </div>

                            <div class="absolute bottom-4 left-4 text-white">
                                <p class="text-xs mb-1">{{ \Carbon\Carbon::parse($announcement->date)->format('d F Y') }}
                                </p>
                                <h3 class="text-lg font-bold leading-snug">
                                    {{ \Illuminate\Support\Str::limit($announcement->content, 60, '...') }}
                                </h3>
                            </div>

                            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-white p-6 text-center z-50">
                                <p class="text-sm">{{ $announcement->content }}</p>
                                <button @click="open = false"
                                    class="mt-4 px-4 py-2 bg-purple-500 rounded hover:bg-purple-600 transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-homepage.layout>