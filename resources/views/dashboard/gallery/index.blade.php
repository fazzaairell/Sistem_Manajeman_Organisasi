<x-dashboard.layout title="Manajemen Gallery">

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="relative bg-gradient-to-br from-pink-600 via-purple-600 to-indigo-600 px-8 py-10">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border-2 border-white/30">
                            <i class="fas fa-images text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white mb-1">Manajemen Gallery</h1>
                            <p class="text-pink-100">Kelola foto dan gambar untuk galeri</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Photo Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-50 to-purple-50 px-6 py-4 border-b border-pink-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-pink-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Tambah Foto Baru</h3>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading text-pink-500"></i>
                                Judul Foto
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   placeholder="Masukkan judul foto" 
                                   required
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all">
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image text-pink-500"></i>
                                Upload Gambar
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="file" 
                                   name="image" 
                                   accept="image/*"
                                   required 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:bg-gradient-to-r file:from-pink-500 file:to-purple-600
                                          file:text-white file:text-sm
                                          file:font-semibold file:cursor-pointer
                                          hover:file:from-pink-600 hover:file:to-purple-700">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-pink-500/30 hover:scale-105 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Simpan Foto</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-purple-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-photo-video text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Koleksi Gallery</h3>
                    <span class="ml-auto px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">{{ $galleries->total() }} Foto</span>
                </div>
            </div>
            
            <div class="p-6">
                @if($galleries->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($galleries as $item)
                            <div class="group bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="{{ filter_var($item->image, FILTER_VALIDATE_URL) ? $item->image : asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    <!-- Overlay on hover -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4">
                                    <h4 class="font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3rem] flex items-center">
                                        <i class="fas fa-image text-pink-500 mr-2 text-sm"></i>
                                        {{ $item->title }}
                                    </h4>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('gallery.edit', $item->id) }}"
                                           class="flex-1 py-2 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white text-center rounded-xl font-semibold text-sm transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-1.5">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button 
                                            x-data
                                            @click="$dispatch('open-delete-modal-{{ $item->id }}')"
                                            class="flex-1 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-semibold text-sm transition-all shadow-sm hover:shadow-md flex items-center justify-center gap-1.5">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal for this item -->
                            <div 
                                x-data="{ open: false }"
                                x-show="open"
                                x-on:open-delete-modal-{{ $item->id }}.window="open = true"
                                x-on:keydown.escape.window="open = false"
                                class="fixed inset-0 z-50 overflow-y-auto"
                                style="display: none;"
                                x-cloak
                            >
                                <div 
                                    x-show="open"
                                    x-transition
                                    class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                                    @click="open = false"
                                ></div>

                                <div class="flex min-h-full items-center justify-center p-4">
                                    <div 
                                        x-show="open"
                                        x-transition
                                        class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden"
                                        @click.away="open = false"
                                    >
                                        <div class="h-2 bg-gradient-to-r from-red-500 to-red-600"></div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-trash-alt text-red-500 text-xl"></i>
                                                </div>
                                                <h3 class="text-xl font-bold text-gray-900">Hapus Foto?</h3>
                                            </div>
                                            
                                            <div class="mb-6">
                                                <p class="text-gray-600 mb-3">Apakah Anda yakin ingin menghapus foto ini?</p>
                                                <div class="p-3 bg-gray-50 rounded-xl border border-gray-200">
                                                    <p class="font-semibold text-gray-900 flex items-center gap-2">
                                                        <i class="fas fa-image text-pink-500"></i>
                                                        {{ $item->title }}
                                                    </p>
                                                </div>
                                                <p class="text-sm text-red-600 mt-3">
                                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                                    Tindakan ini tidak dapat dibatalkan!
                                                </p>
                                            </div>

                                            <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex gap-3">
                                                    <button 
                                                        type="button"
                                                        @click="open = false"
                                                        class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                                        <i class="fas fa-times mr-2"></i>
                                                        Batal
                                                    </button>
                                                    <button 
                                                        type="submit"
                                                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl transition-all">
                                                        <i class="fas fa-trash-alt mr-2"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($galleries->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $galleries->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-images text-gray-400 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Foto</h3>
                        <p class="text-gray-500">Tambahkan foto pertama Anda menggunakan form di atas</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

</x-dashboard.layout>