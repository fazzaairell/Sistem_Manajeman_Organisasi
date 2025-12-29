<x-dashboard.layout title="Manajemen Gallery">

<div class="container">
    <h2 class="text-xl font-semibold text-gray-800">Manajemen Gallery</h2>

    <div class="card mb-4 p-3">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="title" class="form-control" placeholder="Judul Foto" required>
                </div>
                <div class="col-md-5">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach($galleries as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                <div class="card-body">
                    <p class="fw-bold">{{ $item->title }}</p>
                    <div class="d-flex gap-2">
                       <div class="d-flex gap-2 mt-3">
    <a href="{{ route('gallery.edit', $item->id) }}" 
       class="btn btn-sm btn-warning text-black">
       Ubah
    </a>
                        <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</x-dashboard.layout>