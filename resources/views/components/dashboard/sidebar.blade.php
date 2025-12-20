<aside class="w-64 bg-white shadow-lg relative">

    <div class="p-6 border-b border-gray-300/40">
        <div class="flex items-center space-x-3 ">
            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-xl"></i>
            </div>
            <h1 class="text-xl font-bold">InTech</h1>
        </div>
    </div>

    <nav class="p-4">
        <p class="text-xs text-gray-500 uppercase mb-3 px-3">Platform</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard')
                            ? 'bg-purple-50 text-purple-600 font-semibold'
                            : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('')
                            ? 'bg-purple-50 text-purple-600 font-semibold'
                            : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Event</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*')
                            ? 'bg-purple-50 text-purple-600 font-semibold'
                            : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Announcement</span>
                </a>
            </li>
            <li>
                <a href="{{ route('general.edit') }}"
                    class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('general.*')
                            ? 'bg-purple-50 text-purple-600 font-semibold'
                            : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-cog w-5"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>

    


    <div class="absolute bottom-0 px-4 py-6 border-t border-gray-300/40" id="userDropdownContainer">
        <button id="userDropdownButton"
                class="flex items-center gap-3 w-full text-left focus:outline-none">
            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-semibold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex flex-col">
                <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                <span class="text-xs text-gray-500">Administrator</span>
            </div>
            <svg id="userDropdownArrow" class="ml-auto h-4 w-4 text-gray-500 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

\        <div id="userDropdownMenu"
            class="absolute left-0 bottom-full mb-2 w-full bg-white rounded-md shadow-lg border z-50 origin-bottom scale-0 transform transition-transform"
            style="transform-origin: bottom;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>




</aside>