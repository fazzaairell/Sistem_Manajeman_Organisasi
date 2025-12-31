<aside class="w-64 bg-white shadow-lg relative">

    <div class="p-6 border-b border-gray-300/40">
        <div class="flex items-center space-x-3 ">
            <a href="{{ route('home') }}" class="w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center">
                <i class="fas fa-building text-white text-xl"></i>
            </a>
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
                <a href="{{ route('events.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('events.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Event</span>
                </a>
            </li>
            <li>
                <a href="{{ route('event-registrations.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('event-registrations.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-clipboard-list w-5"></i>
                    <span>Pendaftaran Event</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('users.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-users w-5"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('announcements.index') }}" class="flex items-center space-x-3 px-3 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition {{ request()->routeIs('announcements.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Announcement</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('gallery.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'}}">
        <i class="fas fa-image w-5"></i>
        <span>Gallery</span>
     </a>
    </li>
        </ul>

        <p class="text-xs text-gray-500 uppercase mt-6 mb-3 px-3">Akun</p>
        <ul class="space-y-1">
            <li>
                <a href="{{ route('general.profile') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('general.*')
    ? 'bg-purple-50 text-purple-600 font-semibold'
    : 'text-gray-600 hover:bg-gray-50'
                       }}">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
        </ul>
    </nav>




    <div class="absolute bottom-0  mb-5 ">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block w-full px-8 py-2 text-left text-red-600 cursor-pointer">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>



</aside>