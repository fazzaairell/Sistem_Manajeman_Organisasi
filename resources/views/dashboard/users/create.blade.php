<x-dashboard.layout title="Tambah User">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                    Tambah User Baru
                </h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi formulir untuk menambahkan pengguna baru</p>
            </div>
            <a href="{{ route('users.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-purple-500 mr-1"></i>
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        placeholder="Masukkan nama lengkap" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-purple-500 mr-1"></i>
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        placeholder="email@example.com" required>
                    @error('email')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-at text-purple-500 mr-1"></i>
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        placeholder="username" required>
                    @error('username')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-shield-halved text-purple-500 mr-1"></i>
                        Role <span class="text-red-500">*</span>
                    </label>
                    <select name="role_id"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-500 mr-1"></i>
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        required placeholder="********">
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        Minimal 8 karakter, kombinasi huruf besar & kecil
                    </p>
                    @error('password')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-500 mr-1"></i>
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                        required placeholder="********">
                </div>

                <!-- Foto Profile -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-purple-500 mr-1"></i>
                        Foto Profile <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="file" name="photo" accept="image/*" 
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-3 file:px-4
                                file:rounded-xl file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gradient-to-r file:from-purple-50 file:to-purple-100
                                file:text-purple-700
                                hover:file:from-purple-100 hover:file:to-purple-200
                                file:cursor-pointer file:transition-all
                                border border-gray-200 rounded-xl
                                focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG, GIF • Maksimal 2MB
                    </p>
                    @error('photo')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                    <i class="fas fa-times text-sm"></i>
                    <span>Batal</span>
                </a>
                <button type="submit" 
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-purple-500/30">
                    <i class="fas fa-save text-sm"></i>
                    <span>Simpan User</span>
                </button>
            </div>
        </form>

    </div>
</x-dashboard.layout>