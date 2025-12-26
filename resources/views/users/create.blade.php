<x-dashboard.layout title="Tambah User">


    <div class="bg-white shadow-sm p-6 space-y-6 p-10">

        <h1 class="text-xl font-semibold text-gray-800 border-b py-3 border-gray-300/40">Tambahkan User Baru</h1>

        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        placeholder="email@example.com" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        placeholder="username" required>
                    @error('username')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role_id"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        required placeholder="********">
                    <p class="mt-1 text-xs text-gray-500">
                        Minimal 8 karakter, kombinasi huruf besar & kecil
                    </p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                        required placeholder="********">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Foto Profile (Opsional)
                    </label>
                    <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500
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
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                <a href="{{ route('users.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                    Simpan User
                </button>
            </div>
        </form>



    </div>
</x-dashboard.layout>