<x-dashboard.layout title="Detail Pendaftaran">

    <div class="max-w-5xl mx-auto space-y-6">
        
        <!-- Back Button -->
        <div>
            <a href="{{ route('event-registrations.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl transition-colors shadow-sm border border-gray-200">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Pendaftaran</span>
            </a>
        </div>

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 px-8 py-10">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Avatar/Icon -->
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border-2 border-white/30">
                                <i class="fas fa-ticket-alt text-white text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-white mb-1">Detail Pendaftaran Event</h1>
                                <div class="flex items-center gap-3">
                                    <span class="text-indigo-100 text-sm font-medium">ID: #{{ str_pad($eventRegistration->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-indigo-200">•</span>
                                    <span class="text-indigo-100 text-sm">{{ $eventRegistration->registered_at->format('d F Y, H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status Badge -->
                        @if($eventRegistration->status === 'pending')
                            <div class="px-5 py-2.5 bg-yellow-400 text-yellow-900 rounded-full text-sm font-bold shadow-lg shadow-yellow-500/30 flex items-center gap-2">
                                <span class="w-2 h-2 bg-yellow-600 rounded-full animate-pulse"></span>
                                <i class="fas fa-clock"></i>
                                <span>Menunggu</span>
                            </div>
                        @elseif($eventRegistration->status === 'approved')
                            <div class="px-5 py-2.5 bg-green-400 text-green-900 rounded-full text-sm font-bold shadow-lg shadow-green-500/30 flex items-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                <span>Disetujui</span>
                            </div>
                        @else
                            <div class="px-5 py-2.5 bg-red-400 text-red-900 rounded-full text-sm font-bold shadow-lg shadow-red-500/30 flex items-center gap-2">
                                <i class="fas fa-times-circle"></i>
                                <span>Ditolak</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Event Info Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-blue-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Event</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 p-4 bg-blue-50/50 rounded-xl">
                                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-bullhorn text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide mb-1">Nama Event</p>
                                    <p class="text-lg font-bold text-gray-900">{{ $eventRegistration->event->title }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($eventRegistration->event->description, 100) }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-calendar-check text-blue-500"></i>
                                        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide">Tanggal Mulai</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($eventRegistration->event->start_date)->format('d M Y') }}</p>
                                </div>

                                <div class="p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-calendar-times text-blue-500"></i>
                                        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide">Tanggal Selesai</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($eventRegistration->event->end_date)->format('d M Y') }}</p>
                                </div>

                                <div class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-toggle-on text-purple-500"></i>
                                        <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Status Event</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">{{ ucfirst($eventRegistration->event->status) }}</p>
                                </div>

                                <div class="p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-user-tie text-purple-500"></i>
                                        <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Penanggung Jawab</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">{{ $eventRegistration->event->penanggung_jawab }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Details Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-700 rounded-xl flex items-center justify-center">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Detail Pendaftaran</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        
                        @if($eventRegistration->reason)
                            <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide mb-2 flex items-center gap-2">
                                    <i class="fas fa-comment-dots"></i>
                                    Alasan Mendaftar
                                </p>
                                <p class="text-gray-700 leading-relaxed">{{ $eventRegistration->reason }}</p>
                            </div>
                        @endif

                        @if($eventRegistration->reviewed_at)
                            <div class="flex items-center gap-3 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                                <i class="fas fa-clock text-indigo-500 text-xl"></i>
                                <div>
                                    <p class="text-xs text-indigo-600 font-semibold uppercase tracking-wide">Tanggal Review</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $eventRegistration->reviewed_at->format('d F Y, H:i') }} WIB</p>
                                </div>
                            </div>
                        @endif

                        @if($eventRegistration->reviewer)
                            <div class="flex items-center gap-3 p-4 bg-purple-50 rounded-xl border border-purple-100">
                                <i class="fas fa-user-check text-purple-500 text-xl"></i>
                                <div>
                                    <p class="text-xs text-purple-600 font-semibold uppercase tracking-wide">Direview Oleh</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $eventRegistration->reviewer->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if($eventRegistration->admin_notes)
                            <div class="p-4 bg-amber-50 rounded-xl border border-amber-200">
                                <p class="text-xs text-amber-700 font-semibold uppercase tracking-wide mb-2 flex items-center gap-2">
                                    <i class="fas fa-sticky-note"></i>
                                    Catatan Admin
                                </p>
                                <p class="text-gray-700 leading-relaxed">{{ $eventRegistration->admin_notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right Column - Participant Info & Actions -->
            <div class="space-y-6">
                
                <!-- Participant Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Data Peserta</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col items-center mb-6">
                            @if($eventRegistration->user->image)
                                <img src="{{ asset('storage/' . $eventRegistration->user->image) }}" 
                                     class="w-24 h-24 rounded-full object-cover border-4 border-purple-100 shadow-lg mb-4">
                            @else
                                @php
                                    $nameParts = explode(' ', $eventRegistration->user->name);
                                    $initials = count($nameParts) >= 2 
                                        ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                        : strtoupper(substr($eventRegistration->user->name, 0, 2));
                                @endphp
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-3xl mb-4 shadow-lg border-4 border-white">
                                    {{ $initials }}
                                </div>
                            @endif
                            <h4 class="text-xl font-bold text-gray-900 text-center">{{ $eventRegistration->user->name }}</h4>
                            <p class="text-sm text-gray-500 text-center">{{ $eventRegistration->user->email }}</p>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-xl">
                                <i class="fas fa-at text-purple-500"></i>
                                <div>
                                    <p class="text-xs text-purple-600 font-semibold">Username</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $eventRegistration->user->username }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-xl">
                                <i class="fas fa-id-card text-pink-500"></i>
                                <div>
                                    <p class="text-xs text-pink-600 font-semibold">NRP</p>
                                    <p class="text-sm font-bold text-gray-900">{{ $eventRegistration->user->nrp ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                @if($eventRegistration->isPending())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-orange-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tasks text-white"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Aksi</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <form method="POST" action="{{ route('event-registrations.approve', $eventRegistration->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        onclick="return confirm('Setujui pendaftaran ini?')"
                                        class="w-full px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-green-500/30 hover:scale-105">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Setujui Pendaftaran
                                </button>
                            </form>

                            <button 
                                x-data
                                @click="$dispatch('open-reject-modal')"
                                class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-red-500/30 hover:scale-105">
                                <i class="fas fa-times-circle mr-2"></i>
                                Tolak Pendaftaran
                            </button>
                        </div>
                    </div>

                    <!-- Reject Modal -->
                    <div 
                        x-data="{ open: false }"
                        x-show="open"
                        x-on:open-reject-modal.window="open = true"
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
                                            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">Tolak Pendaftaran</h3>
                                    </div>
                                    <form method="POST" action="{{ route('event-registrations.reject', $eventRegistration->id) }}" class="space-y-4">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                                <i class="fas fa-comment-dots text-red-500 mr-1"></i>
                                                Alasan Penolakan <span class="text-red-500">*</span>
                                            </label>
                                            <textarea 
                                                name="admin_notes" 
                                                rows="4" 
                                                placeholder="Berikan alasan penolakan yang jelas..." 
                                                required
                                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
                                        </div>

                                        <div class="flex gap-3 pt-2">
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
                                                <i class="fas fa-ban mr-2"></i>
                                                Tolak
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

</x-dashboard.layout>
