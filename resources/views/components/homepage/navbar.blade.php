<div class="relative bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">

            <!-- Logo -->
            <h1 class="text-xl font-bold text-purple-950">InTech</h1>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8 font-semibold">
                <a href="{{ route('home') }}" class="hover:text-purple-500">Beranda</a>
                <a href="#event" class="hover:text-purple-500">Event</a>
                <a href="#pengumuman" class="hover:text-purple-500">Pengumuman</a>
                <a href="#galeri" class="hover:text-purple-500">Galeri</a>
                <a href="#kontak" class="hover:text-purple-500">Kontak</a>
            </nav>

            <!-- User / Login -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="inline-flex items-center gap-2.5 px-3 py-2 text-sm rounded-xl bg-white border border-gray-200 hover:border-purple-300 hover:shadow-md transition-all group">
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
                        <span
                            class="font-medium text-gray-700 group-hover:text-purple-600">{{ auth()->user()->username }}</span>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-purple-600 transition-transform group-hover:rotate-180"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 font-semibold rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:scale-95">
                        Masuk
                    </a>
                @endauth
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-purple-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2">
        <a href="{{ route('home') }}" class="block py-2 px-3 rounded hover:bg-purple-50">Beranda</a>
        <a href="#event" class="block py-2 px-3 rounded hover:bg-purple-50">Event</a>
        <a href="#pengumuman" class="block py-2 px-3 rounded hover:bg-purple-50">Pengumuman</a>
        <a href="#galeri" class="block py-2 px-3 rounded hover:bg-purple-50">Galeri</a>
        <a href="#kontak" class="block py-2 px-3 rounded hover:bg-purple-50">Kontak</a>

        @auth
            <a href="{{ route('general.profile') }}" class="block py-2 px-3 rounded hover:bg-purple-50">Profil Saya</a>
            @if(auth()->user()->role?->name === 'admin')
                <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-purple-50">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left py-2 px-3 rounded hover:bg-red-50 text-red-600">Keluar</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block py-2 px-3 rounded bg-purple-500 text-white text-center">Masuk</a>
        @endauth
    </div>
</div>

<script>
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>