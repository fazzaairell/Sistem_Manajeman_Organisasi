<x-dashboard.layout title="Edit Gallery">

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Back Button -->
        <div>
            <a href="{{ route('gallery.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition-colors shadow-sm border border-gray-200">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Gallery</span>
            </a>
        </div>

        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="relative bg-gradient-to-br from-pink-600 via-purple-600 to-indigo-600 px-8 py-10">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border-2 border-white/30">
                            <i class="fas fa-edit text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-1">Edit Gallery</h1>
                            <p class="text-pink-100">Perbarui informasi foto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-pink-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Foto</h3>
                </div>
            </div>
            
            <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div>
                    <label for="title" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-heading text-pink-500"></i>
                        Judul Foto
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ $gallery->title }}"
                           placeholder="Masukkan judul foto" 
                           required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all">
                </div>

                <!-- Current Image Preview -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-image text-pink-500"></i>
                        Gambar Saat Ini
                    </label>
                    <div class="relative w-full">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-4">
                            <img src="{{ filter_var($gallery->image, FILTER_VALIDATE_URL) ? $gallery->image : asset('storage/' . $gallery->image) }}" 
                                 alt="{{ $gallery->title }}"
                                 class="w-full rounded-xl shadow-xl border-4 border-white object-cover">
                        </div>
                        <div class="absolute top-6 right-6">
                            <span class="px-4 py-2 bg-pink-500 text-white text-sm font-bold rounded-xl shadow-xl">
                                <i class="fas fa-check-circle mr-1.5"></i>
                                Gambar Aktif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Upload New Image -->
                <div>
                    <label for="image" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-cloud-upload-alt text-pink-500"></i>
                        Ganti Gambar
                        <span class="text-xs text-gray-500 font-normal">(Opsional - Kosongkan jika tidak ingin mengubah)</span>
                    </label>
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:bg-gradient-to-r file:from-pink-500 file:to-purple-600
                                  file:text-white file:text-sm
                                  file:font-semibold file:cursor-pointer
                                  hover:file:from-pink-600 hover:file:to-purple-700">
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-pink-500/30 hover:scale-105 flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('gallery.index') }}"
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>
            </form>
        </div>

    </div>

</x-dashboard.layout>