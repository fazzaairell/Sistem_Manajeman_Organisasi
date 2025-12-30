<x-dashboard.layout title="Manajemen Gallery">

    <div class="max-w-6xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manajemen Gallery</h2>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <input type="text" name="title" placeholder="Judul Foto" required
                    class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                <input type="file" name="image" required class="border border-gray-300 rounded-md px-3 py-2 cursor-pointer
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:bg-purple-500 file:text-white
                       file:font-semibold file:hover:bg-purple-600
                       focus:outline-none">
                <button type="submit"
                    class="bg-purple-600 text-white rounded-md px-4 py-2 font-semibold hover:bg-purple-700 transition">
                    Simpan
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($galleries as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                        class="h-48 w-full object-cover">
                    <div class="p-4 flex flex-col flex-1">
                        <p class="font-semibold text-gray-800">{{ $item->title }}</p>
                        <div class="mt-auto flex space-x-2 pt-3">
                            <a href="{{ route('gallery.edit', $item->id) }}"
                                class="flex-1 bg-yellow-400 text-black text-center py-1 rounded-md font-medium hover:bg-yellow-500 transition">
                                Ubah
                            </a>
                            <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" class="flex-1">
                                @csrf 
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-500 text-white py-1 rounded-md font-medium hover:bg-red-600 transition"
                                    onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-dashboard.layout>