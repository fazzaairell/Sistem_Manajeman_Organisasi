<x-dashboard.layout title="Edit Pengumuman">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent">
                    Edit Pengumuman
                </h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi pengumuman</p>
            </div>
            <a href="{{ route('announcements.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Title (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-emerald-500 mr-1"></i>
                        Judul Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           value="{{ old('title', $announcement->title) }}"
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
                        <i class="fas fa-tag text-emerald-500 mr-1"></i>
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pendaftaran" {{ old('category', $announcement->category) == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                        <option value="Akademik" {{ old('category', $announcement->category) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Prestasi" {{ old('category', $announcement->category) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Event" {{ old('category', $announcement->category) == 'Event' ? 'selected' : '' }}>Event</option>
                        <option value="Teknis" {{ old('category', $announcement->category) == 'Teknis' ? 'selected' : '' }}>Teknis</option>
                        <option value="Sertifikat" {{ old('category', $announcement->category) == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                        <option value="Umum" {{ old('category', $announcement->category) == 'Umum' ? 'selected' : '' }}>Umum</option>
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
                        <i class="fas fa-star text-emerald-500 mr-1"></i>
                        Prioritas <span class="text-red-500">*</span>
                    </label>
                    <select name="priority" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="normal" {{ old('priority', $announcement->priority) == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="penting" {{ old('priority', $announcement->priority) == 'penting' ? 'selected' : '' }}>Penting</option>
                        <option value="urgent" {{ old('priority', $announcement->priority) == 'urgent' ? 'selected' : '' }}>Urgent</option>
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
                        <i class="fas fa-circle-dot text-emerald-500 mr-1"></i>
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                            required>
                        <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                        <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draf</option>
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
                        <i class="fas fa-user-edit text-emerald-500 mr-1"></i>
                        Penulis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="author" 
                           value="{{ old('author', $announcement->author) }}"
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
                        <i class="fas fa-calendar text-emerald-500 mr-1"></i>
                        Tanggal Pengumuman <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="date" 
                           value="{{ old('date', $announcement->date->format('Y-m-d')) }}"
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
                        <i class="fas fa-clock text-emerald-500 mr-1"></i>
                        Tanggal Kedaluwarsa <span class="text-gray-400">(Opsional)</span>
                    </label>
                    <input type="date" 
                           name="expires_at" 
                           value="{{ old('expires_at', $announcement->expires_at ? $announcement->expires_at->format('Y-m-d') : '') }}"
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
                        <i class="fas fa-align-left text-emerald-500 mr-1"></i>
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              rows="3" 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                              placeholder="Ringkasan singkat tentang pengumuman ini..."
                              required>{{ old('description', $announcement->description) }}</textarea>
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
                        <i class="fas fa-file-alt text-emerald-500 mr-1"></i>
                        Konten Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" 
                              rows="8" 
                              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                              placeholder="Tulis konten lengkap pengumuman di sini..."
                              required>{{ old('content', $announcement->content) }}</textarea>
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
                        <i class="fas fa-image text-emerald-500 mr-1"></i>
                        Gambar <span class="text-gray-400">(Opsional)</span>
                    </label>
                    @if($announcement->image)
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ filter_var($announcement->image, FILTER_VALIDATE_URL) ? $announcement->image : asset('storage/' . $announcement->image) }}" 
                                 class="h-32 w-48 object-cover rounded-xl border-2 border-gray-200"
                                 id="current-preview">
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" 
                               name="image" 
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-3 file:px-4
                                   file:rounded-xl file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-gradient-to-r file:from-emerald-50 file:to-emerald-100
                                   file:text-emerald-700
                                   hover:file:from-emerald-100 hover:file:to-emerald-200
                                   file:cursor-pointer file:transition-all
                                   border border-gray-200 rounded-xl
                                   focus:outline-none focus:ring-2 focus:ring-emerald-500"
                               onchange="previewImage(event)">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG • Maksimal 2MB • Kosongkan jika tidak ingin mengubah gambar
                    </p>
                    <div id="preview" class="hidden mt-3">
                        <p class="text-xs text-gray-500 mb-2">Preview Gambar Baru:</p>
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
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-save text-sm"></i>
                    <span>Update Pengumuman</span>
                </button>
            </div>
        </form>

    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewImg = document.getElementById('preview-img');
            const currentPreview = document.getElementById('current-preview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (currentPreview) currentPreview.style.opacity = '0.5';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-dashboard.layout>
