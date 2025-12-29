<x-dashboard.layout title="Manajemen Announcement">

    <div class="bg-white shadow-sm p-6 space-y-6 p-10">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Manajemen Announcement</h1>

            <a href="{{ route('announcements.create') }}"
                class="inline-flex items-center gap-2 px-3 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                <i class="fas fa-plus"></i>
                <span>Tambah Announcement</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Gambar</th>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Konten</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300/40">
                    @forelse($announcements as $index => $ann)
                        <tr>
                            <td class="p-3 ">
                                {{ $announcements->firstItem() + $index }}
                            </td>

                            <td class="p-3">
                                @if($ann->image)
                                    <img src="{{ asset('storage/' . $ann->image) }}" class="w-20 h-14 rounded object-cover">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <td class="p-3">{{ $ann->date }}</td>

                            <td class="p-3">{{ Str::limit($ann->content, 60) }}</td>

                            <td class="p-3 gap-3 align-middle">
                                <div class="flex items-center gap-3">
                                    <button data-modal-target="edit-event-{{ $ann->id }}"
                                        data-modal-toggle="edit-event-{{ $ann->id }}"
                                        class="text-blue-600 inline-flex items-center gap-1">
                                        <i class="fas fa-pen-to-square text-lg"></i>
                                    </button>
                                    <div id="edit-event-{{ $ann->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                        <div class="relative w-full max-w-xl p-4">
                                            <div class="bg-white rounded-xl shadow-lg p-6">

                                                <div
                                                    class="flex justify-between items-center border-b border-gray-300/40 pb-3">
                                                    <h3 class="text-lg font-semibold text-gray-800">
                                                        Ubah Data Announcement
                                                    </h3>
                                                    <button data-modal-hide="edit-event-{{ $ann->id }}"
                                                        class="text-gray-400 hover:text-gray-600">
                                                        ✕
                                                    </button>
                                                </div>

                                                <form action="{{ route('announcements.update', $ann->id) }}" method="POST"
                                                    enctype="multipart/form-data" class="space-y-4 pt-4">
                                                    @csrf
                                                    @method('PUT')

                                                    <div>
                                                        <label class="text-sm font-medium">Content</label>
                                                        <input type="text" name="content" value="{{ $ann->content }}"
                                                            class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                            required>
                                                    </div>

                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="text-sm font-medium">Tanggal</label>
                                                            <input type="date" name="date" value="{{ $ann->date }}"
                                                                class="w-fit rounded-lg border-gray-300 focus:outline-none"
                                                                required>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="text-sm font-medium">Deskripsi</label>
                                                        <textarea name="description" rows="3"
                                                            class="w-full rounded-lg border-gray-300 focus:outline-none">{{ $ann->description }}</textarea>
                                                    </div>

                                                    <div>
                                                        <label class="text-sm font-medium">Foto Announcement</label>
                                                        @if($ann->image)
                                                            <img src="{{ asset('storage/' . $ann->image) }}"
                                                                class="w-24 mb-2 rounded-lg">
                                                        @endif
                                                        <input type="file" name="image"
                                                            class="w-full text-sm focus:outline-none">
                                                    </div>

                                                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                                                        <button type="button" data-modal-hide="edit-event-{{ $ann->id }}"
                                                            class="px-4 py-2 bg-gray-100 rounded-lg">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                            class="px-5 py-2 bg-blue-500 text-white rounded-lg">
                                                            Update
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('announcements.destroy', $ann->id) }}"
                                        onsubmit="return confirm('Yakin hapus announcement?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center gap-1 text-red-600 hover:underline">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Tidak ada data announcement
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-dashboard.layout>