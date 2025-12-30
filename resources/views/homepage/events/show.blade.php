<x-homepage.layout>
    <div class="max-w-6xl mx-auto mt-12 mb-20 px-4">

        <!-- Back Button -->
        <a href="{{ route('events.public') }}" 
           class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium mb-8 group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Semua Event
        </a>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            
            <!-- Hero Image with Gradient Overlay -->
            <div class="relative h-96 overflow-hidden bg-gradient-to-br from-purple-100 to-blue-100">
                @if($event->image)
                    <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}"
                        alt="{{ $event->title }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('image/page.png') }}"
                        alt="Default event image" class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                
                <!-- Status Badge on Image -->
                <div class="absolute top-6 right-6">
                    <span class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold backdrop-blur-md shadow-xl
                        {{ $event->status === 'aktif' ? 'bg-green-500 text-white' : 
                           ($event->status === 'mendatang' ? 'bg-blue-500 text-white' : 'bg-gray-500 text-white') }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>

                <!-- Title Overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $event->title }}</h1>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8 md:p-12">
                
                <!-- Info Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Date Card -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Tanggal</p>
                            </div>
                        </div>
                        <p class="text-lg font-bold text-purple-900">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        </p>
                        <p class="text-sm text-purple-700">
                            s/d {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- PIC Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide">Penanggung Jawab</p>
                            </div>
                        </div>
                        <p class="text-lg font-bold text-blue-900">{{ $event->penanggung_jawab }}</p>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-green-600 font-semibold uppercase tracking-wide">Status Event</p>
                            </div>
                        </div>
                        <p class="text-lg font-bold text-green-900">{{ ucfirst($event->status) }}</p>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <div class="w-1 h-8 bg-gradient-to-b from-purple-600 to-blue-600 rounded-full mr-3"></div>
                        Tentang Event
                    </h2>
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $event->description }}</p>
                </div>

                <!-- Registration Form -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <div class="w-1 h-8 bg-gradient-to-b from-purple-600 to-blue-600 rounded-full mr-3"></div>
                        Daftar Event
                    </h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('events.register', $event->id) }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap Anda"
                                class="block w-full border-2 border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" placeholder="contoh@email.com"
                                class="block w-full border-2 border-gray-300 rounded-xl shadow-sm px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all"
                                required>
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-bold hover:from-purple-700 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>
</x-homepage.layout>