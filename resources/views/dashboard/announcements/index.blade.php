<x-dashboard.layout title="Manajemen Pengumuman">
    <div class="px-6 py-8" x-data="{ showCreateModal: false }">
        
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengumuman</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi dan berita terbaru untuk anggota.</p>
            </div>
            <button @click="showCreateModal = true" 
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-medium hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5">
                <i class="fas fa-plus"></i>
                <span>Tambah Pengumuman</span>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form method="GET" action="{{ route('announcements.index') }}" class="relative" x-data="{ searching: false }">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           @input="searching = true; $el.form.submit()"
                           placeholder="Cari berdasarkan deskripsi, konten, atau tanggal..." 
                           class="w-full pl-12 pr-12 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm">
                    @if(request('search'))
                        <a href="{{ route('announcements.index') }}" 
                           class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
                @if(request('search'))
                    <p class="mt-2 text-sm text-gray-500">
                        Menampilkan hasil pencarian untuk: <span class="font-semibold text-gray-700">"{{ request('search') }}"</span>
                    </p>
                @endif
            </form>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center space-x-2 animate-fade-in-down shadow-sm">
                <i class="fas fa-check-circle text-green-500"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase font-semibold text-xs tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4 w-32">Gambar</th>
                            <th class="px-6 py-4 w-48">Info</th>
                            <th class="px-6 py-4">Konten</th>
                            <th class="px-6 py-4 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($announcements as $index => $ann)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4 text-center font-medium text-gray-400">
                                    {{ $announcements->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="h-16 w-24 rounded-lg overflow-hidden border border-gray-100 shadow-sm relative group-hover:shadow-md transition-all">
                                        @if($ann->image)
                                            <img src="{{ Str::startsWith($ann->image, 'http') ? $ann->image : asset('storage/' . $ann->image) }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-300">
                                                <i class="fas fa-image text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2 text-indigo-600 font-medium text-xs">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($ann->date)->format('d M Y') }}
                                        </div>
                                        @if($ann->description)
                                            <span class="text-gray-800 font-semibold line-clamp-2" title="{{ $ann->description }}">
                                                {{ $ann->description }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Tidak ada deskripsi</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-600 line-clamp-3 leading-relaxed">{{ $ann->content }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- View Detail Button -->
                                        <a href="{{ route('announcements.show', $ann->id) }}" 
                                           class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-100 transition-colors"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>

                                        <!-- Edit Modal Trigger -->
                                        <div x-data="{ showEditModal: false }">
                                            <button @click="showEditModal = true" 
                                                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors"
                                                    title="Edit">
                                                <i class="fas fa-pen text-xs"></i>
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

                                                        <form action="{{ route('announcements.update', $ann->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf @method('PUT')
                                                            <div class="px-6 py-6 space-y-5">
                                                                <!-- Image Preview & Input -->
                                                                <div>
                                                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Gambar Banner</label>
                                                                    <div class="flex items-start gap-4">
                                                                        @if($ann->image)
                                                                            <img src="{{ Str::startsWith($ann->image, 'http') ? $ann->image : asset('storage/' . $ann->image) }}" class="w-32 h-20 object-cover rounded-lg border border-gray-200">
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
                                                                        <input type="date" name="date" value="{{ $ann->date }}" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>
                                                                    </div>
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                                                                        <input type="text" name="description" value="{{ $ann->description }}" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Ringkasan singkat...">
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Konten Lengkap</label>
                                                                    <textarea name="content" rows="6" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>{{ $ann->content }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                                                                <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl content-center font-medium hover:bg-gray-50 transition-colors">Batal</button>
                                                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-xl font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Action -->
                                        <form method="POST" action="{{ route('announcements.destroy', $ann->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors" title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-bullhorn text-2xl"></i>
                                        </div>
                                        <p class="font-medium">Belum ada pengumuman</p>
                                        <p class="text-sm mt-1">Buat pengumuman pertama Anda sekarang.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($announcements->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>

        <!-- Create Modal -->
        <div x-show="showCreateModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showCreateModal = false"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">
                    
                    <!-- Create Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-5">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-white flex items-center gap-3">
                                <i class="fas fa-plus-circle"></i> Tambah Pengumuman
                            </h3>
                            <button @click="showCreateModal = false" class="text-white/80 hover:text-white transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-6 space-y-5">
                            <!-- Image Input -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Gambar Banner</label>
                                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition-all cursor-pointer">
                                <p class="text-xs text-gray-400 mt-2">Mendukung JPG, PNG. Maks 2MB.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="md:col-span-1">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal</label>
                                    <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" required>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                                    <input type="text" name="description" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Ringkasan pendek..." required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Konten Lengkap</label>
                                <textarea name="content" rows="5" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" placeholder="Tulis isi pengumuman lengkap di sini..." required></textarea>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                            <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-xl font-medium hover:bg-purple-700 shadow-lg shadow-purple-200 transition-all">Simpan Pengumuman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-dashboard.layout>