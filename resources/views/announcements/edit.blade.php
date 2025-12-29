<x-dashboard.layout title="Edit Announcement">
    <style>
        body { font-family: sans-serif; margin: 40px; }
        .form-section { background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ddd; max-width: 600px; }
        input, textarea { display: block; width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; }
        button { background: #963fc9ff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
        .btn-back { text-decoration: none; color: #666; margin-left: 10px; }
    </style>
</head>
<body>

    <h2>Edit Pengumuman</h2>

    <div class="form-section">
        <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <label>Tanggal:</label>
            <input type="date" name="date" value="{{ $announcement->date }}" required>

            <label>Isi Pengumuman:</label>
            <textarea name="content" rows="5" required>{{ $announcement->content }}</textarea>

            <label>Foto Baru (Kosongkan jika tidak ingin diubah):</label>
            <input type="file" name="image">
            
            @if($announcement->image)
                <p>Gambar saat ini: <br> <img src="{{ asset('storage/' . $announcement->image) }}" width="100"></p>
            @endif

            <button type="submit">Update Pengumuman</button>
            <a href="{{ route('announcements.index') }}" class="btn-back">Batal</a>
        </form>
    </div>

</x-dashboard.layout>