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
                            <td class="p-3">
                                {{ $announcements->firstItem() + $index }}
                            </td>

                            <td class="p-3">
                                @if($ann->image)
                                    <img src="{{ asset('storage/' . $ann->image) }}"
                                         class="w-20 h-14 rounded object-cover">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <td class="p-3">{{ $ann->date }}</td>

                            <td class="p-3">{{ Str::limit($ann->content, 60) }}</td>

                            <td class="p-3 flex gap-2">
                                <a href="{{ route('announcements.edit', $ann->id) }}"
                                   class="text-blue-600 inline-flex items-center gap-1 hover:underline">
                                    <i class="fas fa-pen"></i>
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('announcements.destroy', $ann->id) }}"
                                      onsubmit="return confirm('Yakin hapus announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center gap-1 text-red-600 hover:underline">
                                        <i class="fas fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
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
