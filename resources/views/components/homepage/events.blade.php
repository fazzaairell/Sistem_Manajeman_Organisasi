@props(['events'])

<div id="event" class="relative flex justify-center items-center mt-16 mb-20 px-4">
    <div class="w-full max-w-7xl space-y-8">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-purple-950 mb-2">
                    Event Kami
                </h1>
                <p class="text-gray-600 text-sm sm:text-base">
                    Ikuti berbagai kegiatan menarik dari organisasi kami
                </p>
            </div>

            <a href="{{ route('events.public') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg hover:bg-purple-700 transition-all hover:shadow-lg w-fit">
                <span class="font-semibold text-sm sm:text-base">Lihat semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>


        @if($events->count() > 0)
            <!-- Swiper Slider -->
            <div class="relative mt-8">
                <div class="swiper eventSwiper">
                    <div class="swiper-wrapper pb-12">
                        @foreach($events as $event)
                            <div class="swiper-slide">
                                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:-translate-y-2 h-full">
                                    <!-- Image with Overlay -->
                                    <div class="relative w-full h-52 overflow-hidden bg-gradient-to-r from-purple-100 to-blue-100">
                                        @if($event->image)
                                            <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}"
                                                alt="{{ $event->title }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                        @else
                                            <img src="{{ asset('image/page.png') }}"
                                                alt="Default image"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        
                                        <!-- Status Badge -->
                                        <div class="absolute top-4 right-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm
                                                {{ $event->status === 'aktif' ? 'bg-green-500/90 text-white' : 
                                                   ($event->status === 'mendatang' ? 'bg-blue-500/90 text-white' : 'bg-gray-500/90 text-white') }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-5 sm:p-6 flex flex-col min-h-[220px]">
                                        <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                                            {{ $event->title }}
                                        </h3>

                                        <div class="space-y-2 mb-4 flex-grow">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</span>
                                            </div>

                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span class="truncate">{{ $event->penanggung_jawab }}</span>
                                            </div>
                                        </div>

                                        <!-- Button -->
                                        <a href="{{ route('events.show', $event->id) }}" 
                                           class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-gradient-to-r from-purple-500 to-blue-600 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-blue-700 transition-all shadow-md hover:shadow-lg">
                                            <span>Lihat Detail</span>
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Navigation buttons -->
\                    <div class="swiper-button-next hidden md:flex !w-12 !h-12 !bg-white !rounded-full !shadow-lg after:!text-purple-600 after:!text-xl !right-0"></div>
                    <div class="swiper-button-prev hidden md:flex !w-12 !h-12 !bg-white !rounded-full !shadow-lg after:!text-purple-600 after:!text-xl !left-0"></div>

                    
                    <!-- Pagination -->
                    <div class="swiper-pagination !bottom-0"></div>
                </div>
            </div>

            <!-- Initialize Swiper -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const swiper = new Swiper('.eventSwiper', {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        loop: false,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                            dynamicBullets: true,
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 20,
                            },
                            1024: {
                                slidesPerView: 3,
                                spaceBetween: 24,
                            },
                        },
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                    });
                });
            </script>

            <!-- Custom Pagination Styles for Light Mode -->
            <style>
                .swiper-pagination-bullet {
                    width: 10px;
                    height: 10px;
                    background: #9333ea;
                    opacity: 0.3;
                }
                .swiper-pagination-bullet-active {
                    opacity: 1;
                    background: linear-gradient(to right, #9333ea, #3b82f6);
                }
            </style>

        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="text-gray-500 text-lg font-medium">Belum ada event yang tersedia saat ini</p>
                <p class="text-gray-400 text-sm mt-2">Event baru akan segera hadir!</p>
            </div>
        @endif

    </div>

</div>