<x-dashboard.layout title="Detail Pengumuman">
    <div class="px-6 py-8 max-w-5xl mx-auto">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('announcements.index') }}" 
               class="inline-flex items-center gap-2 text-gray-600 hover:text-indigo-600 transition-colors group">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span class="font-medium">Kembali ke Daftar</span>
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <!-- Header Image -->
            @if($announcement->image)
                <div class="h-80 w-full overflow-hidden bg-gradient-to-br from-indigo-50 to-purple-50">
                    <img src="{{ Str::startsWith($announcement->image, 'http') ? $announcement->image : asset('storage/' . $announcement->image) }}" 
                         class="w-full h-full object-cover"
                         alt="{{ $announcement->description }}">
                </div>
            @else
                <div class="h-80 w-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-bullhorn text-6xl text-indigo-300 mb-4"></i>
                        <p class="text-indigo-400 font-medium">Tidak ada gambar</p>
                    </div>
                </div>
            @endif

            <!-- Content -->
            <div class="p-8 space-y-6">
                
                <!-- Meta Info -->
                <div class="flex items-center gap-4 text-sm">
                    <div class="flex items-center gap-2 text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full">
                        <i class="far fa-calendar-alt"></i>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($announcement->date)->format('d F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-500">
                        <i class="far fa-clock"></i>
                        <span>Dibuat {{ $announcement->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Description -->
                @if($announcement->description)
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                            {{ $announcement->description }}
                        </h1>
                    </div>
                @endif

                <!-- Divider -->
                <div class="border-t border-gray-100"></div>

                <!-- Full Content -->
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $announcement->content }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center gap-3 pt-6 border-t border-gray-100">
                    <div x-data="{ showEditModal: false }">
                        <button @click="showEditModal = true" 
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-all shadow-lg shadow-blue-200">
                            <i class="fas fa-pen"></i>
                            <span>Edit Pengumuman</span>
                        </button>

                        <!-- Edit Modal -->
                        <div x-show="showEditModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showEditModal = false"></div>

                            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">
                                    
                                    <!-- Edit Header -->
                                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-5">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                                <i class="fas fa-pen-to-square"></i> Edit Pengumuman
                                            </h3>
                                            <button @click="showEditModal = false" class="text-white/80 hover:text-white transition-colors">
                                                <i class="fas fa-times text-xl"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="px-6 py-6 space-y-5">
                                            <!-- Image Preview & Input -->
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Gambar Banner</label>
                                                <div class="flex items-start gap-4">
                                                    @if($announcement->image)
                                                        <img src="{{ Str::startsWith($announcement->image, 'http') ? $announcement->image : asset('storage/' . $announcement->image) }}" class="w-32 h-20 object-cover rounded-lg border border-gray-200">
                                                    @endif
                                                    <div class="flex-1">
                                                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all cursor-pointer">
                                                        <p class="text-xs text-gray-400 mt-2">Mendukung JPG, PNG. Maks 2MB.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                                <div class="md:col-span-1">
                                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal</label>
                                                    <input type="date" name="date" value="{{ $announcement->date }}" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                                                    <input type="text" name="description" value="{{ $announcement->description }}" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Ringkasan singkat...">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Konten Lengkap</label>
                                                <textarea name="content" rows="6" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>{{ $announcement->content }}</textarea>
                                            </div>
                                        </div>

                                        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">Batal</button>
                                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('announcements.destroy', $announcement->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-all shadow-lg shadow-red-200">
                            <i class="fas fa-trash"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-dashboard.layout>
