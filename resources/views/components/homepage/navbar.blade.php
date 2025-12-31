<div class="flex justify-center items-center relative z-50">
    <div
        class="w-full md:w-[70%] relative flex items-center justify-between p-6 md:p-8 border-b border-gray-300/40 font-semibold">

        <h1 class="text-lg font-bold">InTech</h1>

        <nav class="hidden md:block">
            <ul class="flex items-center space-x-10">
                <li><a href="{{ route('home') }}" class="hover:text-purple-500">Beranda</a></li>
                <li><a href="#event" class="hover:text-purple-500">Event</a></li>
                <li><a href="#pengumuman" class="hover:text-purple-500">Pengumuman</a></li>
                <li><a href="#galeri" class="hover:text-purple-500">Galeri</a></li>
                <li><a href="#kontak" class="hover:text-purple-500">Kontak</a></li>
            </ul>
        </nav>

        <div class="flex items-center gap-4">

            @auth
                <div class="relative">
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" type="button"
                        class="inline-flex items-center gap-2.5 px-3 py-2 text-sm rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white border border-gray-200 hover:border-purple-300 hover:shadow-md transition-all group">

                        @php
                            $nameParts = explode(' ', auth()->user()->name);
                            $initials = count($nameParts) >= 2
                                ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                : strtoupper(substr(auth()->user()->name, 0, 2));
                        @endphp

                        @if(auth()->user()->photo)
                            <img class="w-8 h-8 rounded-full object-cover border-2 border-purple-100"
                                src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ $initials }}
                            </div>
                        @endif

                        <span class="font-medium text-white">
                            {{ auth()->user()->username }}
                        </span>

                        <svg class="w-4 h-4 text-white transition-transform group-hover:rotate-180"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownInformation"
                        class="hidden absolute right-0 mt-2 z-50 bg-gradient-to-r from-purple-500 to-indigo-600 border border-gray-200 rounded-2xl shadow-xl w-80 overflow-hidden">

                        <div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                            <div class="flex items-center gap-3">
                                @if(auth()->user()->photo)
                                    <img class="w-12 h-12 rounded-full object-cover border-2 border-white/30"
                                        src="{{ asset('storage/' . auth()->user()->photo) }}">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-lg font-bold border-2 border-white/30">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="font-semibold truncate">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-white/80 truncate">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <ul class="p-2 text-sm">
                            <li>
                                <a href="{{ route('general.profile') }}"
                                    class="flex items-center text-white gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-600">
                                    <span>Profil Saya</span>
                                </a>
                            </li>

                            @if(auth()->user()->role?->name === 'admin')
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="flex items-center text-white gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-600">
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                            @endif

                            <li class="border-t mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:bg-red-50">
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="px-5 py-2 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                    Masuk
                </a>
            @endguest

            <button data-collapse-toggle="mobile-menu"
                class="md:hidden inline-flex items-center justify-center p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</div>

<div id="mobile-menu" class="hidden md:hidden bg-white border-b shadow-md">
    <ul class="flex flex-col gap-2 px-6 py-4 font-medium">
        <li><a href="{{ route('home') }}" class="block py-2 hover:text-purple-500">Beranda</a></li>
        <li><a href="#event" class="block py-2 hover:text-purple-500">Event</a></li>
        <li><a href="#pengumuman" class="block py-2 hover:text-purple-500">Pengumuman</a></li>
        <li><a href="#galeri" class="block py-2 hover:text-purple-500">Galeri</a></li>
        <li><a href="#kontak" class="block py-2 hover:text-purple-500">Kontak</a></li>
    </ul>
</div>