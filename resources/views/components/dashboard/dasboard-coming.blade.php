@props(['events'])

<!-- Upcoming Events -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 h-full">
    <div class="p-6 border-b border-gray-300/40 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800">Event Mendatang</h3>
        <a href="{{ route('events.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
    </div>
    <div class="divide-y divide-gray-300/40">
        @forelse($events as $event)
            <div class="p-6 hover:bg-gray-50 transition">
                <div class="flex items-start space-x-4">
                    <div class="flex flex-col items-center justify-center bg-purple-50 rounded-lg p-3 flex-shrink-0 min-w-[60px]">
                        <span class="text-xs text-purple-600 font-medium uppercase">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span>
                        <span class="text-2xl font-bold text-purple-600">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 font-semibold">{{ $event->title }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        </p>
                        @if($event->penanggung_jawab)
                            <p class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-user-tie mr-1"></i>{{ $event->penanggung_jawab }}
                            </p>
                        @endif
                         <span class="inline-block mt-2 px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full font-medium">
                            {{ $event->status }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500 text-sm">Tidak ada event mendatang.</div>
        @endforelse
    </div>
</div>