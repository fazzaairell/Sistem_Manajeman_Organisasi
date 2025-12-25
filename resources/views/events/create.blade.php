<x-dashboard.layout title="Manajemen Event">
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .form-section { background: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #eee; }
        .btn-edit { color: blue; text-decoration: none; margin-right: 10px; font-weight: bold; }
        .btn-delete { color: red; background: none; border: none; cursor: pointer; padding: 0; font-weight: bold; font-family: sans-serif; }
        .alert { padding: 10px; background-color: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 5px; }
        input, textarea { display: block; width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button[type="submit"] { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Manajemen Event</h2>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-section">
        <h3>Tambah Event Baru</h3>
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Judul Event" required>
            <input type="text" name="status" placeholder="Status (contoh: Mendatang)" required>
            <label>Tanggal Mulai:</label>
            <input type="date" name="start_date" required>
            <label>Tanggal Selesai:</label>
            <input type="date" name="end_date" required>
            <input type="text" name="penanggung_jawab" placeholder="Penanggung Jawab" required>
            <textarea name="description" placeholder="Deskripsi"></textarea>
            <label>Foto Event:</label>
            <input type="file" name="image">
            <button type="submit">Tambah Event</button>
        </form>
    </div>

    <hr>

    <h3>Daftar Event</h3>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Penanggung Jawab</th>
                <th>Deskripsi</th>
                <th>Aksi</th> </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" width="60">
                    @else
                        <small>No Image</small>
                    @endif
                </td>
                <td>{{ $event->title }}</td>
                <td><strong>{{ $event->status }}</strong></td>
                <td>{{ $event->start_date }} / {{ $event->end_date }}</td>
                <td>{{ $event->penanggung_jawab }}</td>
                <td>{{ $event->description }}</td>
                <td>
                    <form action="{{ route('events.edit', $event->id) }}"  style="display:inline 10px;">
                        <button type="submit" class="btn-edit">Ubah</button>
                    </form>
                    <br>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</x-dashboard.layout>