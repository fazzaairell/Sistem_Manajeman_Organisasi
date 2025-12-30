@props(['announcements'])

<div id="pengumuman" class="relative flex justify-center items-center mt-20 mb-20">
    
    <div class="w-[85%] max-w-7xl space-y-8">
        <!-- Single Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-purple-950 mb-2">Pengumuman Terkini</h1>
                <p class="text-gray-600">Informasi dan pengumuman penting untuk Anda</p>
            </div>
            <a href="{{ route('announcements.public') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all hover:shadow-lg">
                <span class="font-semibold">Lihat semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- Announcement Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($announcements as $announcement)
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:-translate-y-2">
                    
                    <!-- Image with Overlay -->
                    <div class="relative w-full h-48 overflow-hidden bg-gradient-to-br from-purple-100 to-blue-100">
                        @if($announcement->image)
                            <img src="{{ filter_var($announcement->image, FILTER_VALIDATE_URL) ? $announcement->image : asset('storage/' . $announcement->image) }}"
                                alt="{{ $announcement->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                        @else
                            <img src="{{ asset('images/default-announcement.png') }}"
                                alt="Default announcement"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold backdrop-blur-sm shadow-lg
                                {{ $announcement->category === 'Prestasi' ? 'bg-yellow-500 text-white' : 
                                   ($announcement->category === 'Akademik' ? 'bg-blue-500 text-white' : 
                                   ($announcement->category === 'Event' ? 'bg-green-500 text-white' :
                                   ($announcement->category === 'Teknis' ? 'bg-red-500 text-white' : 'bg-purple-500 text-white'))) }}">
                                {{ $announcement->category }}
                            </span>
                        </div>

                        <!-- Date Badge -->
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center gap-2 text-white backdrop-blur-sm bg-black/30 px-3 py-1 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-semibold">{{ \Carbon\Carbon::parse($announcement->date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-purple-600 transition-colors">
                            {{ $announcement->title }}
                        </h3>

                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ $announcement->description }}
                        </p>

                        <!-- Author Info -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">{{ $announcement->author }}</span>
                            </div>

                            <!-- Read More Button -->
                            <button x-data @click="$dispatch('open-announcement-modal', { announcement: {{ json_encode($announcement) }} })"
                                class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold text-sm group/btn">
                                <span>Baca</span>
                                <svg class="w-4 h-4 ml-1 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg font-medium">Belum ada pengumuman</p>
                    <p class="text-gray-400 text-sm mt-2">Pengumuman terbaru akan muncul di sini</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal for Announcement Detail -->
    <div x-data="{ 
        open: false, 
        announcement: null,
        init() {
            this.$watch('open', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            });
        }
    }"
         @open-announcement-modal.window="announcement = $event.detail.announcement; open = true"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
             @click="open = false"
             x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden"
                 x-show="open"
                 @click.away="open = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Close Button -->
                <button @click="open = false" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Modal Image -->
                <div class="relative h-64 bg-gradient-to-br from-purple-100 to-blue-100">
                    <img :src="announcement?.image || '{{ asset('images/default-announcement.png') }}'"
                         :alt="announcement?.title"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold backdrop-blur-sm shadow-lg bg-white/90 text-purple-600"
                              x-text="announcement?.category"></span>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3" x-text="announcement?.title"></h2>
                    
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span x-text="announcement?.date ? new Date(announcement.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : ''"></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span x-text="announcement?.author"></span>
                        </div>
                    </div>

                    <p class="text-gray-700 leading-relaxed mb-4" x-text="announcement?.content"></p>

                    <button @click="open = false"
                            class="mt-6 w-full py-3 px-6 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>