<x-dashboard.layout title="Manajemen Event">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6" 
         x-data="{ 
             search: '{{ request('search') }}',
             loading: false,
             
             async searchEvents() {
                 this.loading = true;
                 try {
                     const response = await fetch(`{{ route('events.index') }}?search=${this.search}`, {
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
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    Manajemen Event
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola semua event organisasi Anda</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('events.export-pdf', ['search' => request('search')]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-green-500/30">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export PDF</span>
                </a>
                <a href="{{ route('events.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Tambah Event</span>
                </a>
            </div>
        </div>

        <!-- Search Bar with Live Search -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input 
                type="text" 
                x-model="search"
                x-on:input.debounce.300ms="searchEvents()"
                placeholder="Cari judul event, penanggung jawab, atau status..."
                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            <div x-show="loading" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                <svg class="animate-spin h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Event</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Penanggung Jawab</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $index => $event)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-600">
                                {{ $events->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $event->title }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($event->description, 40) }}</div>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                <div class="text-xs">
                                    <div>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</div>
                                    <div class="text-gray-400">s/d {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if($event->status === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @elseif($event->status === 'mendatang')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                        Mendatang
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                                        Selesai
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $event->penanggung_jawab }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('events.edit', $event->id) }}"
                                       class="w-9 h-9 inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>
                                    <button 
                                        @click="$dispatch('open-delete-modal-event-{{ $event->id }}')"
                                        type="button"
                                        class="w-9 h-9 inline-flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>

                                    <!-- Delete Form (Hidden) -->
                                    <div x-data="{ deleteForm: null }"
                                         @confirm-delete-event-{{ $event->id }}.window="deleteForm = $refs.deleteForm{{ $event->id }}; deleteForm.submit()">
                                        <form ref="deleteForm{{ $event->id }}" method="POST" action="{{ route('events.destroy', $event->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <x-dashboard.delete-modal
                            id="event-{{ $event->id }}"
                            title="Hapus Event?"
                            message="Apakah Anda yakin ingin menghapus event '{{ $event->title }}'? Tindakan ini tidak dapat dibatalkan."
                        />
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-calendar-xmark text-5xl mb-3"></i>
                                    <p class="text-sm font-medium">Tidak ada data event</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-200 pt-4">
            {{ $events->links() }}
        </div>

    </div>

</x-dashboard.layout>
