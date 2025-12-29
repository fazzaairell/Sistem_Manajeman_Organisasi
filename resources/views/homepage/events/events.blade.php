<x-homepage.layout>

    <div class="relative flex flex-col items-center mt-24 space-y-8">
        <div class="w-[70%] space-y-6">
            @forelse($events as $event)
                <div class="relative bg-white rounded-xl shadow-lg overflow-hidden flex flex-col h-full">

                    <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.png') }}"
                        alt="Event Image" class="w-full h-80 object-contain">

                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-green-600 font-semibold text-sm">{{ $event->status }}</p>

                        <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $event->title }}</h3>

                        <p class="text-gray-600 text-sm mt-1">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                        </p>

                        <p class="text-gray-600 text-sm mt-1">📌 {{ $event->penanggung_jawab }}</p>

                        <p class="text-gray-700 text-sm mt-3 flex-1">
                            {{ \Illuminate\Support\Str::limit($event->description, 100, '...') }}
                        </p>

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('events.show', $event->id) }}"
                                class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                                Ikuti Event →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Belum ada event.</p>
            @endforelse

        </div>
    </div>

</x-homepage.layout>