<div class="flex justify-center items-center">
    <div class="w-[70%] relative flex justify-between p-8 border-b border-gray-300/40 font-semibold">
        <h1>InTech</h1>
        <nav>
            <ul class="flex justify-center items-center space-x-10">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-purple-500">Beranda</a>
                </li>
                <li>
                    <a href="#about" class="hover:text-purple-500">Tentang Kami</a>
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
                    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:scale-95"
                    type="button">
                    {{ auth()->user()->username }}
                    <svg class="w-4 h-4 ms-1.5 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownInformation"
                    class="z-10 hidden bg-white border border-gray-300/60 rounded-base shadow-lg w-72">
                    <div class="p-2">
                        <div class="flex items-center px-2.5 p-2 space-x-1.5 text-sm rounded">
                            <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->photo }}" alt="Rounded avatar">
                            <div class="text-sm">
                                <div class="font-medium text-heading">{{ auth()->user()->username }}</div>
                                <div class="truncate text-body">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    <ul class="px-2 pb-2 text-sm text-body font-medium" aria-labelledby="dropdownInformationButton">
                        <li>
                            <a href="#" class="inline-flex items-center w-full p-2  hover:text-heading rounded transition-all duration-200 ease-in-out
                                                 hover:bg-purple-50 hover:translate-x-1">
                                <i class="fas fa-user w-5"></i>Account
                            </a>
                        </li>
                        @if(auth()->user()->role?->name === 'admin')
                            <li>
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center w-full p-2 hover:text-heading rounded transition-all
                                                       hover:bg-purple-50 hover:translate-x-1">
                                    <i class="fas fa-chart-line w-5"></i>Dashboard
                                </a>
                            </li>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center w-full p-2 text-fg-danger rounded transition-all duration-200 ease-in-out
                                                             hover:bg-red-50 hover:translate-x-1">
                               <i class="fas fa-right-from-bracket w-5"></i>
                                Sign out
                            </button>
                        </form>
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