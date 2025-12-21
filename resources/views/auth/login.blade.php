<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    @vite([
        'resources/css/app.css',
        'resources/css/auth.css',
        'resources/js/auth.js'
    ])
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#e5e7eb] via-[#e0e7ff] to-[#dbeafe]">

    <div id="container"
        class="relative w-[900px] h-[520px] bg-white rounded-3xl overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)]">

        {{-- Login --}}
        <div
            class="sign-in absolute inset-y-0 left-0 w-1/2 flex items-center justify-center transition-all duration-700 z-20">

            <form method="POST" action="{{ route('login') }}" class="w-[320px] text-center space-y-5">
                @csrf

                <h1 class="text-2xl font-bold">Sign In</h1>

                @error('login')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <input type="text" name="username" value="{{ old('username') }}" placeholder="username"
                    class="w-full px-5 py-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" required>

                @error('username')
                    <p class="text-sm text-red-600 text-left">{{ $message }}</p>
                @enderror

                <input type="password" name="password" placeholder="Password"
                    class="w-full px-5 py-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500" required>

                @error('password')
                    <p class="text-sm text-red-600 text-left">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full bg-purple-600 text-white py-3 rounded-full hover:bg-purple-700 transition">
                    SIGN IN
                </button>


            </form>

        </div>

        {{-- Register --}}
        <div
            class="sign-up absolute inset-y-0 left-0 w-1/2 flex items-center justify-center opacity-0 transition-all duration-700 z-10">

            <form method="POST" action="{{ route('register') }}" class="w-[340px] text-center space-y-4">
                @csrf

                <h1 class="text-2xl font-bold">Create Account</h1>

                @if (session('register_success'))
                    <p class="text-green-600 text-sm">{{ session('register_success') }}</p>
                @endif

                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap"
                    class="w-full px-5 py-3 rounded-xl bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required>

                @error('name')
                    <p class="text-red-500 text-sm text-left">{{ $message }}</p>
                @enderror

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full px-5 py-3 rounded-xl bg-gray-100
                        focus:outline-none focus:ring-2 focus:ring-purple-500" required>

                @error('email')
                    <p class="text-red-500 text-sm text-left">{{ $message }}</p>
                @enderror

                <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="w-full px-5 py-3 rounded-xl bg-gray-100
                        focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                @error('username')
                    <p class="text-red-500 text-sm text-left">{{ $message }}</p>
                @enderror

                <input type="password" name="password" placeholder="Password" class="w-full px-5 py-3 rounded-xl bg-gray-100
                        focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                @error('password')
                    <p class="text-red-500 text-sm text-left">{{ $message }}</p>
                @enderror

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full px-5 py-3 rounded-xl bg-gray-100
                        focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                <button type="submit" class="w-full bg-purple-600 text-white py-3
                        rounded-full hover:bg-purple-700 transition mt-2">
                    SIGN UP
                </button>

                <p class="text-xs text-gray-500 mt-2 italic">
                    Semua pendaftar otomatis terdaftar sebagai Mahasiswa
                </p>

            </form>

        </div>

        {{-- Overlay --}}
        <div
            class="overlay-container absolute inset-y-0 left-1/2 w-1/2 transition-all duration-700 z-50 overflow-hidden">

            <div class="overlay relative -left-full w-[200%] h-full bg-gradient-to-r from-purple-500 to-indigo-600
                    transition-all duration-700">

                {{-- Left --}}
                <div class="absolute w-1/2 h-full flex flex-col justify-center items-center
                        text-white px-12 text-center">
                    <h1 class="text-3xl font-bold">Welcome Back!</h1>
                    <p class="mt-4 mb-6 text-sm opacity-90">
                        To keep connected please login
                    </p>
                    <button id="signIn" type="button" class="border border-white px-10 py-2 rounded-full">
                        SIGN IN
                    </button>
                </div>



                {{-- Right --}}
                <div
                    class="absolute right-0 w-1/2 h-full flex flex-col justify-center items-center text-white px-12 text-center">
                    <h1 class="text-3xl font-bold">Hello, Friend!</h1>
                    <p class="mt-4 mb-6 text-sm opacity-90">
                        Enter your personal details
                    </p>
                    <button id="signUp" type="button" class="border border-white px-10 py-2 rounded-full">
                        SIGN UP
                    </button>
                </div>

            </div>

        </div>

    </div>

</body>

</html>