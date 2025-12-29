<x-dashboard.layout title="Manajemen Gallery">
    
<div class="container">
    <h3>Ubah Gambar</h3>
    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
        </div>
        <div class="mb-3">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

</x-dashboard.layout>