<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengumuman</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .form-section { background: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 20px; }
        input, textarea { display: block; width: 100%; margin-bottom: 10px; padding: 8px; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-delete { color: red; background: none; border: none; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Manajemen Pengumuman</h2>

    <div class="form-section">
        <h3>Tambah Pengumuman Baru</h3>
        <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Tanggal:</label>
            <input type="date" name="date" required>
            
            <label>Isi Pengumuman:</label>
            <textarea name="content" rows="4" placeholder="Tulis pengumuman di sini..." required></textarea>
            
            <label>Foto Pengumuman:</label>
            <input type="file" name="image">
            
            <button type="submit">Tambah Pengumuman</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Tanggal</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $ann)
            <tr>
                <td>
                    @if($ann->image)
                        <img src="{{ asset('storage/' . $ann->image) }}" width="80">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $ann->date }}</td>
                <td>{{ $ann->content }}</td>
                <td>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <a href="{{ route('announcements.edit', $ann->id) }}" 
                    style="background-color: #007bff; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold; display: inline-block;">
                    Ubah
                    </a>

                    <form action="{{ route('announcements.destroy', $ann->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Untuk Menghapus?')" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                style="background-color: #007bff; color: white; padding: 8px 15px; border: none; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer;">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>