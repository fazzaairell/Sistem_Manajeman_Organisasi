<x-dashboard.layout title="Manajemen Event">
     <h3>Manajemen Event</h3>
     <br>

    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #636161ff; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn-edit { color: blue; font-weight: bold; text-decoration: none; }
        .btn-delete { color: red; background: none; border: none; cursor: pointer; font-weight: bold; }
    </style>

    <div style="margin-bottom: 15px;">
        <a href="{{ route('events.create') }}" style="background: #963fc9ff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Tambah Event Baru</a>
    </div>

    <div style="margin-bottom: 20px; background: #f4f4f4; padding: 15px; border-radius: 8px; border: 1px solid #636161ff;">
        <form action="{{ route('events.index') }}" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}" style="padding: 10px; flex-grow: 1;">
            <button type="submit" style="background-color: #963fc9ff; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Penanggung Jawab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    @if($event->image)
                        <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}" width="60">
                    @else
                        <small>No Image</small>
                    @endif
                </td>
                <td>{{ $event->title }}</td>
                <td><strong>{{ $event->status }}</strong></td>
                <td>{{ $event->penanggung_jawab }}</td>
                <td>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn-edit">Ubah</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda Yakin Menghapus Event Ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-dashboard.layout>