<x-homepage.layout>
    <div class="max-w-4xl mx-auto mt-12 bg-white shadow-lg rounded-lg overflow-hidden p-4">

        <div class="md:flex gap-6">

            <div class="md:w-1/2 h-48 md:h-auto rounded overflow-hidden">
                <img src="{{ $event->image ? asset('storage/' . $event->image) : '/storage/photos/page.png' }}"
                    alt="{{ $event->title }}" class="w-full h-full object-cover object-center">
            </div>

            <div class="md:w-1/2 mt-4 md:mt-0 flex flex-col space-y-1">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $event->title }}</h1>

                <p class="text-green-600 font-semibold">{{ $event->status }}</p>

                <p class="text-gray-600 text-sm">
                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                </p>

                <p class="text-gray-600 text-sm">📌 {{ $event->penanggung_jawab }}</p>

                <p class="text-gray-700 mt-2">{{ $event->description }}</p>
            </div>
        </div>

        <div class="mt-6">
            @if(session('success'))
                <div class="p-3 bg-green-100 text-green-800 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="p-3 bg-red-100 text-red-800 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('events.register', $event->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan nama"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"
                        required>
                </div>

                <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition">
                    Daftar Event
                </button>
                <a href="{{ route('home') }}"
                    class="mt-4 inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Kembali ke daftar Event
                </a>
            </form>
        </div>

    </div>
</x-homepage.layout>