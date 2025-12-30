<x-dashboard.layout title="Edit Gallery">

    <div class="max-w-3xl mx-auto py-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Ubah Gambar</h3>

        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-md rounded-lg p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-gray-700 font-medium mb-1">Judul</label>
                <input type="text" name="title" id="title" value="{{ $gallery->title }}"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                    placeholder="Masukkan judul gambar" required>
            </div>

            <div>
                <label for="image" class="block text-gray-700 font-medium mb-1">Ganti Gambar (Opsional)</label>
                <input type="file" name="image" id="image" class="w-full text-gray-700 border border-gray-300 rounded-md px-3 py-2 cursor-pointer
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:bg-purple-500 file:text-white
                       file:font-semibold file:hover:bg-purple-600
                       focus:outline-none">
            </div>

            <div class="flex items-center space-x-3 mt-4">
                <button type="submit"
                    class="bg-purple-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-purple-700 transition">
                    Perbarui
                </button>
                <a href="{{ route('gallery.index') }}"
                    class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md font-medium hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</x-dashboard.layout>