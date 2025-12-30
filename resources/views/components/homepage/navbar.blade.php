<div class="flex justify-center items-center">
    <div class="w-[70%] relative flex justify-between p-8 border-b border-gray-300/40 font-semibold">
        <h1>InTech</h1>
        <nav>
            <ul class="flex justify-center items-center space-x-10">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-purple-500">Beranda</a>
                </li>
                <li>
                    <a href="#event" class="hover:text-purple-500">Event</a>
                </li>
                <li>
                    <a href="#pengumuman" class="hover:text-purple-500">Pengumuman</a>
                </li>
                <li>
                    <a href="#galeri" class="hover:text-purple-500">Galeri</a>
                </li>
                <li>
                    <a href="#kontak" class="hover:text-purple-500">Kontak</a>
                </li>
            </ul>
        </nav>
        <div>
            @auth
                <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                    class="inline-flex items-center gap-2.5 px-3 py-2 text-sm rounded-xl bg-white border border-gray-200 hover:border-purple-300 hover:shadow-md transition-all group"
                    type="button">
                    @php
                        $nameParts = explode(' ', auth()->user()->name);
                        $initials = count($nameParts) >= 2 
                            ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                            : strtoupper(substr(auth()->user()->name, 0, 2));
                    @endphp
                    
                    @if(auth()->user()->photo)
                        <img class="w-8 h-8 rounded-full object-cover border-2 border-purple-100" 
                             src="{{ asset('storage/' . auth()->user()->photo) }}" 
                             alt="{{ auth()->user()->name }}">
                    @else
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                            {{ $initials }}
                        </div>
                    @endif
                    
                    <span class="font-medium text-gray-700 group-hover:text-purple-600">{{ auth()->user()->username }}</span>
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-purple-600 transition-transform group-hover:rotate-180" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                
                <!-- Dropdown menu -->
                <div id="dropdownInformation"
                    class="z-10 hidden bg-white border border-gray-200 rounded-2xl shadow-xl w-80 overflow-hidden">
                    
                    <!-- User Info Header -->
                    <div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                        <div class="flex items-center gap-3">
                            @if(auth()->user()->photo)
                                <img class="w-12 h-12 rounded-full object-cover border-2 border-white/30" 
                                     src="{{ asset('storage/' . auth()->user()->photo) }}" 
                                     alt="{{ auth()->user()->name }}">
                            @else
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-lg font-bold border-2 border-white/30">
                                    {{ $initials }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold truncate">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-white/80 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <ul class="p-2" aria-labelledby="dropdownInformationButton">
                        <li>
                            <a href="{{ route('general.profile') }}" 
                               class="flex items-center gap-3 w-full px-3 py-2.5 text-sm text-gray-700 hover:bg-purple-50 rounded-lg transition-all group">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="font-medium">Profil Saya</span>
                            </a>
                        </li>
                        @if(auth()->user()->role?->name === 'admin')
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center gap-3 w-full px-3 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 rounded-lg transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <span class="font-medium">Dashboard</span>
                                </a>
                            </li>
                        @endif
                        <li class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center gap-3 w-full px-3 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-all group">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-right-from-bracket"></i>
                                    </div>
                                    <span class="font-medium">Keluar</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="w-fit px-5 py-2 font-semibold rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:scale-95">
                    Masuk
                </a>

            @endauth
        </div>
    </div>
</div>