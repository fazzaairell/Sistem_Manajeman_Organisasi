<x-dashboard.layout title="Tambah Pengumuman">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-br from-purple-500 to-indigo-600 bg-clip-text text-transparent">
                    Tambah Pengumuman Baru
                </h1>
                <p class="text-sm text-gray-500 mt-1">Lengkapi formulir untuk menambahkan pengumuman baru</p>
            </div>
            <a href="{{ route('announcements.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Title (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-purple-700 mr-1"></i>
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                           placeholder="Contoh: Pendaftaran Anggota Baru Dibuka"
                           required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-tag text-purple-700 mr-1"></i>
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pendaftaran" {{ old('category') == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                        <option value="Akademik" {{ old('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Prestasi" {{ old('category') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Event</option>
                        <option value="Teknis" {{ old('category') == 'Teknis' ? 'selected' : '' }}>Teknis</option>
                        <option value="Sertifikat" {{ old('category') == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="Umum" {{ old('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Priority -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-star text-purple-700 mr-1"></i>
                        Prioritas <span class="text-red-500">*</span>
                    </label>
                    <select name="priority" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="penting" {{ old('priority') == 'penting' ? 'selected' : '' }}>Penting</option>
                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                    @error('priority')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-circle-dot text-purple-700 mr-1"></i>
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draf</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Author -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-edit text-purple-700 mr-1"></i>
                        Penulis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="author" 
                           value="{{ old('author') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                           placeholder="Contoh: Admin"
                           required>
                    @error('author')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-purple-700 mr-1"></i>
                        Tanggal Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="date" 
                           value="{{ old('date', date('Y-m-d')) }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                           required>
                    @error('date')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Expires At -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-clock text-purple-700 mr-1"></i>
                        Tanggal Kedaluwarsa <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="date" 
                           name="expires_at" 
                           value="{{ old('expires_at') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        Pengumuman tidak akan tampil setelah tanggal ini
                    </p>
                    @error('expires_at')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-purple-700 mr-1"></i>
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              rows="3" 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                              placeholder="Ringkasan singkat tentang pengumuman ini..."
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-alt text-purple-700 mr-1"></i>
                        Konten Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" 
                              rows="8" 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                              placeholder="Tulis konten lengkap pengumuman di sini..."
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-purple-700 mr-1"></i>
                        Gambar <span class="text-gray-400">(Opsional)</span>
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
                                   focus:outline-none focus:ring-2 focus:ring-purple-500"
                               onchange="previewImage(event)">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG • Maksimal 2MB
                    </p>
                    <div id="preview" class="hidden mt-3">
                        <img id="preview-img" class="h-32 w-48 object-cover rounded-xl border-2 border-emerald-200">
                    </div>
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
                <a href="{{ route('announcements.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                    <i class="fas fa-times text-sm"></i>
                    <span>Batal</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-save text-sm"></i>
                    <span>Simpan Pengumuman</span>
                </button>
            </div>
        </form>

    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewImg = document.getElementById('preview-img');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-dashboard.layout>
