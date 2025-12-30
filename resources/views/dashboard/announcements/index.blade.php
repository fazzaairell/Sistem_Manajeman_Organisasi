<x-dashboard.layout title="Manajemen Pengumuman">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6" 
         x-data="{ 
             search: '{{ request('search') }}',
             priority: '{{ request('priority') }}',
             status: '{{ request('status') }}',
             loading: false,
             
             async searchAnnouncements() {
                 this.loading = true;
                 try {
                     const response = await fetch(`{{ route('announcements.index') }}?search=${this.search}&priority=${this.priority}&status=${this.status}`, {
                         headers: {
                             'X-Requested-With': 'XMLHttpRequest',
                             'Accept': 'application/json'
                         }
                     });
                     const html = await response.text();
                     const parser = new DOMParser();
                     const doc = parser.parseFromString(html, 'text/html');
                     const tbody = doc.querySelector('tbody');
                     document.querySelector('tbody').innerHTML = tbody.innerHTML;
                 } catch (error) {
                     console.error('Error:', error);
                 } finally {
                     this.loading = false;
                 }
             }
         }"
    >

        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-800 bg-clip-text text-transparent">
                    Manajemen Pengumuman
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola semua pengumuman organisasi</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('announcements.export-pdf', ['search' => request('search'), 'priority' => request('priority'), 'status' => request('status')]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-green-500/30">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export PDF</span>
                </a>
                <a href="{{ route('announcements.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-emerald-500/30">
                    <i class="fas fa-bullhorn"></i>
                    <span>Tambah Pengumuman</span>
                </a>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1 relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text" 
                    x-model="search"
                    x-on:input.debounce.300ms="searchAnnouncements()"
                    placeholder="Cari judul atau kategori..."
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                >
                <div x-show="loading" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg class="animate-spin h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <select 
                x-model="priority"
                x-on:change="searchAnnouncements()"
                class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                <option value="">Semua Prioritas</option>
                <option value="normal">Normal</option>
                <option value="penting">Penting</option>
                <option value="urgent">Urgent</option>
            </select>

            <select 
                x-model="status"
                x-on:change="searchAnnouncements()"
                class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pengumuman</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prioritas</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($announcements as $index => $ann)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-600">
                                {{ $announcements->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $ann->title }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($ann->description, 50) }}</div>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $categoryColors = [
                                        'Prestasi' => 'bg-yellow-100 text-yellow-700',
                                        'Akademik' => 'bg-blue-100 text-blue-700',
                                        'Event' => 'bg-green-100 text-green-700',
                                        'Teknis' => 'bg-red-100 text-red-700',
                                        'Sertifikat' => 'bg-indigo-100 text-indigo-700',
                                        'Pendaftaran' => 'bg-pink-100 text-pink-700',
                                        'Umum' => 'bg-gray-100 text-gray-700',
                                    ];
                                    $colorClass = $categoryColors[$ann->category] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                    {{ $ann->category }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-gray-600 text-xs">
                                {{ \Carbon\Carbon::parse($ann->date)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($ann->priority === 'urgent')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-circle-exclamation"></i>
                                        Urgent
                                    </span>
                                @elseif($ann->priority === 'penting')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-star"></i>
                                        Penting
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                                        Normal
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if($ann->status === 'published')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        Dipublikasikan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Draf
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('announcements.edit', $ann->id) }}"
                                       class="w-9 h-9 inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>
                                    <button 
                                        @click="$dispatch('open-delete-modal-announcement-{{ $ann->id }}')"
                                        type="button"
                                        class="w-9 h-9 inline-flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>

                                    <!-- Delete Form (Hidden) -->
                                    <div x-data="{ deleteForm: null }"
                                         @confirm-delete-announcement-{{ $ann->id }}.window="deleteForm = $refs.deleteForm{{ $ann->id }}; deleteForm.submit()">
                                        <form ref="deleteForm{{ $ann->id }}" method="POST" action="{{ route('announcements.destroy', $ann->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <x-dashboard.delete-modal
                            id="announcement-{{ $ann->id }}"
                            title="Hapus Pengumuman?"
                            message="Apakah Anda yakin ingin menghapus pengumuman '{{ $ann->title }}'? Tindakan ini tidak dapat dibatalkan."
                        />
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-bullhorn text-5xl mb-3"></i>
                                    <p class="text-sm font-medium">Tidak ada data pengumuman</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-200 pt-4">
            {{ $announcements->links() }}
        </div>

    </div>

</x-dashboard.layout>
