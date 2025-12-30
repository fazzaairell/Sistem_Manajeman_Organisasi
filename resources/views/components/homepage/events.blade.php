@props(['events'])

<div id="event" class="relative flex justify-center items-center mt-[100px]">

    <div class="w-[70%] space-y-2">
        <h2 class="text-purple-950 text-2xl font-semibold">Event Kami</h2>
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold">🎉 • Event - event KAMI</h1>
            <p class="text-blue-800"><a href="{{ route('events.public') }}">Lihat semua →</a></p>
        </div>

        <div class="flex justify-center items-center mt-5 space-x-4">
            @foreach($events as $event)
                <div class="max-w-sm w-[280px] h-[420px] bg-white rounded-lg shadow-md p-6 flex flex-col space-y-3">
                    <div class="w-full h-[150px] rounded-lg overflow-hidden">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : '/storage/photos/page.png' }}"
                            class="w-full h-full object-cover" />
                    </div>

                    <p class="text-green-600 text-sm font-semibold">{{ $event->status }}</p>

                    <h3 class="text-lg font-bold text-gray-900 line-clamp-2">
                        {{ $event->title }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                    </p>

                    <p class="flex items-center text-gray-600 text-sm space-x-1">
                        <span>{{ $event->penanggung_jawab }}</span>
                    </p>

                    <div class="mt-auto">
                        <button class="w-full py-2 bg-purple-300 rounded-md font-semibold hover:bg-purple-400 transition">
                            <a href="{{ route('events.show', $event->id) }}">Lihat Event →</a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>