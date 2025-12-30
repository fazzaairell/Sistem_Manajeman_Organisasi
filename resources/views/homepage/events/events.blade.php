<x-homepage.layout>

    <div class="relative flex flex-col items-center mt-24 mb-20">
        <div class="w-[85%] max-w-7xl">
            
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-purple-950 mb-4">Semua Event</h1>
                <p class="text-lg text-gray-600">Jelajahi dan ikuti berbagai kegiatan menarik dari organisasi kami</p>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($events as $event)
                    <div class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:-translate-y-1">
                        <div class="flex flex-col md:flex-row">
                            <!-- Image Section -->
                            <div class="relative md:w-2/5 h-64 md:h-auto overflow-hidden bg-gradient-to-br from-purple-100 to-blue-100">
                                <img src="{{ $event->image ? (filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image)) : asset('images/default-event.png') }}"
                                    alt="Event Image" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold backdrop-blur-sm shadow-lg
                                        {{ $event->status === 'aktif' ? 'bg-green-500 text-white' : 
                                           ($event->status === 'mendatang' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 p-6 md:p-8 flex flex-col">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors line-clamp-2">
                                    {{ $event->title }}
                                </h3>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">Tanggal</p>
                                            <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 font-medium">PJ</p>
                                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $event->penanggung_jawab }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit($event->description, 150, '...') }}
                                </p>

                                <!-- Button -->
                                <a href="{{ route('events.show', $event->id) }}"
                                    class="inline-flex items-center justify-center w-full py-3 px-6 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl group">
                                    <span>Lihat Detail Event</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-purple-100 rounded-full mb-6">
                            <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Event</h3>
                        <p class="text-gray-500 text-lg">Event baru akan segera hadir. Pantau terus halaman ini!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $events->links() }}
            </div>

        </div>
    </div>

</x-homepage.layout>