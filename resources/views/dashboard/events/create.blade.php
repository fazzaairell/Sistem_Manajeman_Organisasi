<x-dashboard.layout title="Tambah Event">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-500 to-indigo-600 bg-clip-text text-transparent">
                    Tambah Event Baru
                </h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi formulir untuk menambahkan event baru</p>
            </div>
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Judul Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-purple-700 mr-1"></i>
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="Masukkan judul event"
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-toggle-on text-purple-700 mr-1"></i>
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            required>
                        <option value="">-- Pilih Status --</option>
                        <option value="mendatang" {{ old('status') == 'mendatang' ? 'selected' : '' }}>Mendatang</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Penanggung Jawab -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-tie text-purple-700 mr-1"></i>
                        Penanggung Jawab <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="penanggung_jawab"
                           value="{{ old('penanggung_jawab') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="Nama penanggung jawab"
                           required>
                    @error('penanggung_jawab')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-check text-purple-700 mr-1"></i>
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="start_date"
                           value="{{ old('start_date') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           required>
                    @error('start_date')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-times text-purple-700 mr-1"></i>
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="end_date"
                           value="{{ old('end_date') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           required>
                    @error('end_date')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Deskripsi Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-700 mr-1"></i>
                        Deskripsi Event <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description"
                              rows="4"
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                              placeholder="Deskripsi lengkap event"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Gambar Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-purple-700 mr-1"></i>
                        Gambar Event <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="file"
                               name="image"
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-3 file:px-4
                                   file:rounded-xl file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-gradient-to-r file:from-purple-50 file:to-purple-100
                                   file:text-purple-700
                                   hover:file:from-purple-100 hover:file:to-purple-200
                                   file:cursor-pointer file:transition-all
                                   border border-gray-200 rounded-xl
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG • Maksimal 2MB
                    </p>
                    @error('image')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('events.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                    <i class="fas fa-times text-sm"></i>
                    <span>Batal</span>
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-save text-sm"></i>
                    <span>Simpan Event</span>
                </button>
            </div>
        </form>

    </div>

</x-dashboard.layout>
