<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        @if(auth()->check() && auth()->user()->role_id === 1)
            <x-dashboard.sidebar />
        @endif

        <main class="flex-1 overflow-y-auto">

            @if(auth()->check() && auth()->user()->role_id === 1)
                <x-dashboard.header />
            @else
                {{-- Simple header for non-admin users (Mahasiswa) --}}
                <div class="bg-white border-b border-gray-200 px-6 py-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-arrow-left text-lg"></i>
                            </a>
                            <div>
                                <h1 class="text-xl font-bold text-gray-800">Profil Saya</h1>
                                <p class="text-xs text-gray-500">Kelola informasi akun Anda</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $nameParts = explode(' ', auth()->user()->name);
                                $initials = count($nameParts) >= 2 
                                    ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                    : strtoupper(substr(auth()->user()->name, 0, 2));
                            @endphp
                            
                            <div class="flex items-center gap-3">
                                @if(auth()->user()->photo)
                                    <img class="w-10 h-10 rounded-full object-cover border-2 border-purple-200" 
                                         src="{{ asset('storage/' . auth()->user()->photo) }}" 
                                         alt="{{ auth()->user()->name }}">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold">
                                        {{ $initials }}
                                    </div>
                                @endif
                                <div class="text-sm">
                                    <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg font-medium transition">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>

</body>

</html>