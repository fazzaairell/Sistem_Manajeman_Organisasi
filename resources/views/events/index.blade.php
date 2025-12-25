<x-dashboard.layout title="Manajemen Event">
   <div style="margin-bottom: 20px; background: #f4f4f4; padding: 15px; border-radius: 8px; border: 1px solid #ddd;">
    <form action="{{ route('events.index') }}" method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari judul atau penanggung jawab..." 
               value="{{ request('search') }}"
               style="padding: 10px; flex-grow: 1; border: 1px solid #ccc; border-radius: 5px;">
        
        <button type="submit" 
                style="background-color: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
            Cari
        </button>

        @if(request('search'))
            <a href="{{ route('events.index') }}" 
               style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">
               Reset
            </a>
        @endif
    </form>
</div>

    <table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Status</th>
            <th>Penanggung Jawab</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->status }}</td>
            <td>{{ $event->penanggung_jawab }}</td>
            <td>{{ $event->description }}</td>
            <td>
                <a href="{{ route('events.edit', $event->id) }}">Edit</a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</x-dashboard.layout>