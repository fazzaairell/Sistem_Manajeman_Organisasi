<x-dashboard.layout title="Edit Events">
    <style>
        body { font-family: sans-serif; margin: 40px; line-height: 1.6; }
        .container { max-width: 600px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; }
        input, textarea { display: block; width: 100%; margin-bottom: 15px; padding: 10px; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
        .back-link { display: inline-block; margin-top: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2>Ubah Data Event</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <label>Judul Event:</label>
        <input type="text" name="title" value="{{ $event->title }}" required>

        <label>Status:</label>
        <input type="text" name="status" value="{{ $event->status }}" required>

        <label>Tanggal Mulai:</label>
        <input type="date" name="start_date" value="{{ $event->start_date }}" required>

        <label>Tanggal Selesai:</label>
        <input type="date" name="end_date" value="{{ $event->end_date }}" required>

        <label>Penanggung Jawab:</label>
        <input type="text" name="penanggung_jawab" value="{{ $event->penanggung_jawab }}" required>

        <label>Deskripsi:</label>
        <textarea name="description" rows="4">{{ $event->description }}</textarea>

        <label>Foto Event (Kosongkan jika tidak ingin mengubah):</label>
        @if($event->image)
            <div style="margin-bottom: 10px;">
                <img src="{{ asset('storage/' . $event->image) }}" width="100" style="border-radius: 4px;">
            </div>
        @endif
        <input type="file" name="image">

        <button type="submit">Update Event</button>
        <br>
        <a href="{{ route('events.index') }}" class="back-link">Kembali ke Daftar</a>
    </form>
</div>

</x-dashboard.layout>