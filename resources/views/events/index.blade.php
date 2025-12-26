<x-dashboard.layout title="Manajemen Event">

    <div class="bg-white shadow-sm p-10 space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Manajemen Event</h1>

            <div class="flex gap-2">
                <a href="{{ route('events.create') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Tambah Event</span>
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('events.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul atau penanggung jawab..." class="border rounded-lg px-3 py-2 text-sm w-64">

            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('events.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    Reset
                </a>
            @endif
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Judul</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Penanggung Jawab</th>
                        <th class="p-3 text-left">Deskripsi</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300/40">
                    @forelse($events as $index => $event)
                        <tr>
                            <td class="p-3">
                                {{ $events->firstItem() + $index }}
                            </td>

                            <td class="p-3 font-medium">
                                {{ $event->title }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                                        @if($event->status === 'aktif') bg-green-100 text-green-700
                                                        @elseif($event->status === 'selesai') bg-blue-100 text-blue-700
                                                        @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>

                            <td class="p-3">
                                {{ $event->penanggung_jawab }}
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ Str::limit($event->description, 50) }}
                            </td>

                            <td class="p-3 flex gap-2">
                                <button data-modal-target="edit-event-{{ $event->id }}"
                                    data-modal-toggle="edit-event-{{ $event->id }}"
                                    class="text-blue-600 hover:underline inline-flex items-center gap-1">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                                <div id="edit-event-{{ $event->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                    <div class="relative w-full max-w-xl p-4">
                                        <div class="bg-white rounded-xl shadow-lg p-6">

                                            <div class="flex justify-between items-center border-b border-gray-300/40 pb-3">
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    Ubah Data Event
                                                </h3>
                                                <button data-modal-hide="edit-event-{{ $event->id }}"
                                                    class="text-gray-400 hover:text-gray-600">
                                                    ✕
                                                </button>
                                            </div>

                                            <form action="{{ route('events.update', $event->id) }}" method="POST"
                                                enctype="multipart/form-data" class="space-y-4 pt-4">
                                                @csrf
                                                @method('PUT')

                                                <div>
                                                    <label class="text-sm font-medium">Judul Event</label>
                                                    <input type="text" name="title" value="{{ $event->title }}"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                        required>
                                                </div>

                                                <div class="grid grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="text-sm font-medium">Tanggal Mulai</label>
                                                        <input type="date" name="start_date"
                                                            value="{{ $event->start_date }}"
                                                            class="w-fit rounded-lg border-gray-300 focus:outline-none"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label class="text-sm font-medium">Tanggal Selesai</label>
                                                        <input type="date" name="end_date" value="{{ $event->end_date }}"
                                                            class="w-fit rounded-lg border-gray-300 focus:outline-none"
                                                            required>
                                                    </div>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Status</label>
                                                    <select name="status" class="w-fit rounded-lg border-gray-300"
                                                        required>

                                                        <option value="aktif" {{ $event->status === 'aktif' ? 'selected' : '' }}>
                                                            Aktif
                                                        </option>

                                                        <option value="pending" {{ $event->status === 'pending' ? 'selected' : '' }}>
                                                            Pending
                                                        </option>

                                                        <option value="selesai" {{ $event->status === 'selesai' ? 'selected' : '' }}>
                                                            Selesai
                                                        </option>

                                                    </select>

                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Penanggung Jawab</label>
                                                    <input type="text" name="penanggung_jawab"
                                                        value="{{ $event->penanggung_jawab }}"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Deskripsi</label>
                                                    <textarea name="description" rows="3"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none">{{ $event->description }}</textarea>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Foto Event</label>
                                                    @if($event->image)
                                                        <img src="{{ asset('storage/' . $event->image) }}"
                                                            class="w-24 mb-2 rounded-lg">
                                                    @endif
                                                    <input type="file" name="image"
                                                        class="w-full text-sm focus:outline-none">
                                                </div>

                                                <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                                                    <button type="button" data-modal-hide="edit-event-{{ $event->id }}"
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



                                <form method="POST" action="{{ route('events.destroy', $event->id) }}"
                                    onsubmit="return confirm('Yakin hapus event?')">
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
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Tidak ada data event
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $events->links() }}

    </div>

</x-dashboard.layout>