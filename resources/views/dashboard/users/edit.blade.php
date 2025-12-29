<x-dashboard.layout title="Edit User">

    <div class="bg-white shadow-sm rounded-xl p-6 space-y-6">

        <h1 class="text-xl font-semibold text-gray-800 border-b pb-3 border-gray-300/40">
            Edit User
        </h1>

        <form method="POST" action="{{ route('users.update', $user->id) }}"
              enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2 flex items-center gap-4">
                    <div
                        class="w-24 h-24 rounded-full border flex items-center justify-center
                        bg-gray-100 overflow-hidden">

                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}"
                                class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-10 h-10 text-gray-400"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0
                                        3.75 3.75 0 017.5 0zM4.5 20.25
                                        a7.5 7.5 0 0115 0" />
                            </svg>
                        @endif

                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-700">
                            Foto Profile
                        </p>
                        <p class="text-xs text-gray-500">
                            
                        </p>
                    </div>
                </div>


                {{-- Upload Foto --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Upload Foto Baru (Opsional)
                    </label>
                    <input type="file" name="photo" accept="image/*"
                        class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:text-sm file:font-semibold
                        file:bg-purple-50 file:text-purple-700
                        hover:file:bg-purple-100">

                    <p class="mt-1 text-xs text-gray-500">
                        JPG, PNG, GIF • Maks 2MB
                    </p>

                    @error('photo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        required>

                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        required>

                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Username
                    </label>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        required>

                    @error('username')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Role
                    </label>
                    <select name="role_id"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('role_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru
                    </label>
                    <input type="password" name="password"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        placeholder="Kosongkan jika tidak diubah">

                    <p class="mt-1 text-xs text-gray-500">
                        Minimal 8 karakter, kombinasi huruf besar & kecil
                    </p>

                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded-lg border-gray-300
                        focus:border-purple-500 focus:ring-purple-500"
                        placeholder="********">
                </div>

            </div>

            {{-- Action --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                <a href="{{ route('users.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</x-dashboard.layout>
