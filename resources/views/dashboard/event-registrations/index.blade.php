<x-dashboard.layout title="Manajemen Pendaftaran Event">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6" 
         x-data="{ 
             search: '{{ request('search') }}',
             status: '{{ request('status') }}',
             eventId: '{{ request('event_id') }}',
             loading: false,
             selectedIds: [],
             
             async searchRegistrations() {
                 this.loading = true;
                 try {
                     const response = await fetch(`{{ route('event-registrations.index') }}?search=${this.search}&status=${this.status}&event_id=${this.eventId}`, {
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-600 font-medium">Total</p>
                        <p class="text-3xl font-bold text-blue-700 mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-5 border border-yellow-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-yellow-600 font-medium">Menunggu</p>
                        <p class="text-3xl font-bold text-yellow-700 mt-1">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-5 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-green-600 font-medium">Disetujui</p>
                        <p class="text-3xl font-bold text-green-700 mt-1">{{ $stats['approved'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-5 border border-red-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-red-600 font-medium">Ditolak</p>
                        <p class="text-3xl font-bold text-red-700 mt-1">{{ $stats['rejected'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-indigo-800 bg-clip-text text-transparent">
                    Manajemen Pendaftaran Event
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola pendaftaran peserta event</p>
            </div>

            <a href="{{ route('event-registrations.export-pdf', ['status' => request('status'), 'event_id' => request('event_id')]) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-green-500/30">
                <i class="fas fa-file-pdf"></i>
                <span>Export PDF</span>
            </a>
        </div>

        <!-- Search & Filter Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2 relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input 
                    type="text" 
                    x-model="search"
                    x-on:input.debounce.300ms="searchRegistrations()"
                    placeholder="Cari nama peserta atau event..."
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                >
                <div x-show="loading" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg class="animate-spin h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <select 
                x-model="eventId"
                x-on:change="searchRegistrations()"
                class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="">Semua Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>

            <select 
                x-model="status"
                x-on:change="searchRegistrations()"
                class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </select>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Peserta</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($registrations as $index => $registration)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-600">
                                {{ $registrations->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($registration->user->image)
                                        <img src="{{ asset('storage/' . $registration->user->image) }}" alt="{{ $registration->user->name }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        @php
                                            $nameParts = explode(' ', $registration->user->name);
                                            $initials = count($nameParts) >= 2 
                                                ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                                : strtoupper(substr($registration->user->name, 0, 2));
                                        @endphp
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $registration->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $registration->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $registration->event->title }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($registration->event->start_date)->format('d M Y') }}</div>
                            </td>

                            <td class="px-6 py-4 text-gray-600 text-xs">
                                {{ $registration->registered_at->format('d M Y H:i') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($registration->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock"></i>
                                        Menunggu
                                    </span>
                                @elseif($registration->status === 'approved')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle"></i>
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times-circle"></i>
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('event-registrations.show', $registration->id) }}"
                                       class="w-9 h-9 inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-all duration-200 hover:scale-110"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>

                                    @if($registration->isPending())
                                        <form method="POST" action="{{ route('event-registrations.approve', $registration->id) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="w-9 h-9 inline-flex items-center justify-center bg-green-100 hover:bg-green-200 text-green-600 rounded-lg transition-all duration-200 hover:scale-110"
                                                    title="Setujui"
                                                    onclick="return confirm('Setujui pendaftaran ini?')">
                                                <i class="fas fa-check text-sm"></i>
                                            </button>
                                        </form>

                                        <button 
                                            @click="$dispatch('open-reject-modal-{{ $registration->id }}')"
                                            type="button"
                                            class="w-9 h-9 inline-flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-200 hover:scale-110"
                                            title="Tolak">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Reject Modal -->
                        @if($registration->isPending())
                            <div 
                                x-data="{ open: false }"
                                x-show="open"
                                x-on:open-reject-modal-{{ $registration->id }}.window="open = true"
                                x-on:keydown.escape.window="open = false"
                                class="fixed inset-0 z-50 overflow-y-auto"
                                style="display: none;"
                                x-cloak
                            >
                                <div 
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                                    @click="open = false"
                                ></div>

                                <div class="flex min-h-full items-center justify-center p-4">
                                    <div 
                                        x-show="open"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden"
                                        @click.away="open = false"
                                    >
                                        <div class="h-2 bg-gradient-to-r from-red-500 via-red-600 to-red-700"></div>

                                        <div class="p-6">
                                            <div class="mx-auto flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                                                <i class="fas fa-times-circle text-3xl text-red-600"></i>
                                            </div>

                                            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                                                Tolak Pendaftaran?
                                            </h3>

                                            <p class="text-gray-600 text-center text-sm mb-6">
                                                Berikan alasan penolakan untuk {{ $registration->user->name }}
                                            </p>

                                            <form method="POST" action="{{ route('event-registrations.reject', $registration->id) }}" class="space-y-4">
                                                @csrf
                                                @method('PATCH')
                                                <textarea 
                                                    name="admin_notes" 
                                                    rows="4" 
                                                    placeholder="Alasan penolakan..." 
                                                    required
                                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>

                                                <div class="flex gap-3">
                                                    <button 
                                                        type="button"
                                                        @click="open = false"
                                                        class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200">
                                                        Batal
                                                    </button>
                                                    <button 
                                                        type="submit"
                                                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-red-500/30">
                                                        Tolak
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-clipboard-list text-5xl mb-3"></i>
                                    <p class="text-sm font-medium">Tidak ada data pendaftaran</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-200 pt-4">
            {{ $registrations->links() }}
        </div>

    </div>

</x-dashboard.layout>
