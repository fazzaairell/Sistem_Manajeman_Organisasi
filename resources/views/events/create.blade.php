<x-dashboard.layout title="Tambah Event Baru">
    <style>
        .form-section { background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #636161ff; max-width: 600px; }
        input, textarea { display: block; width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button[type="submit"] { padding: 10px 20px; background-color: #963fc9ff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>

    <div class="form-section">
        <h3>Tambah Event Baru</h3>
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Judul Event" required>
            <input type="text" name="status" placeholder="Status (Mendatang)" required>
            <label>Tanggal Mulai:</label>
            <input type="date" name="start_date" required>
            <label>Tanggal Selesai:</label>
            <input type="date" name="end_date" required>
            <input type="text" name="penanggung_jawab" placeholder="Penanggung Jawab" required>
            <textarea name="description" placeholder="Deskripsi"></textarea>
            <label>Foto Event:</label>
            <input type="file" name="image">
            <button type="submit">Tambah Event</button>
            <a href="{{ route('events.index') }}" style="margin-left: 10px; color: gray;">Batal</a>
        </form>
    </div>
</x-dashboard.layout>