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
                {{-- Simple header for non-admin users --}}
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h1 class="text-xl font-bold text-gray-800">Profil Saya</h1>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
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