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
                <div class="max-w-sm bg-white rounded-lg shadow-md p-6 space-y-4 ">
                    <div class="w-[250px] h-[150px] rounded-lg overflow-hidden">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : '/storage/photos/page.png' }}"
                            alt="Event Image" class="w-full h-full object-cover object-center" />
                    </div>



                    <p class="text-green-600 text-sm font-semibold">{{ $event->status }}</p>

                    <h3 class="text-lg font-bold text-gray-900 hover:text-purple-600 cursor-pointer transition-colors">
                        {{ $event->title }}
                    </h3>

                    <p class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                    </p>

                    <p class="flex items-center text-gray-600 text-sm space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline-block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        </svg>
                        <span>{{ $event->penanggung_jawab }}</span>
                    </p>

                    <button class="w-full py-2 bg-purple-300 rounded-md font-semibold hover:bg-purple-400 transition">
                        <a href="{{ route('events.show', $event->id) }}">Lihat Event →</a>
                    </button>
                </div>
            @endforeach
        </div>

    </div>

</div>