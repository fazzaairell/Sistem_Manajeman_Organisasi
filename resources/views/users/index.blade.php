<x-dashboard.layout title="Manajemen User">

    <div class="bg-white shadow-sm p-6 space-y-6 p-10">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Manajemen User</h1>

            <div class="flex gap-2">
                <a href="{{ route('users.create') }}"  
                   class="inline-flex items-center gap-2 px-3 py-2 bg-purple-500 text-white rounded-lg text-sm hover:bg-purple-600">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah User</span>
                </a>

                <a href="{{ route('users.export-pdf') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    Export PDF
                </a>
            </div>
        </div>

        {{-- Search --}}
        <form method="GET" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ $search ?? '' }}"
                   placeholder="Cari nama atau username..."
                   class="border rounded-lg px-3 py-2 text-sm w-64">

            <button class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm">
                Cari
            </button>
        </form>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Username</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300/40">
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="p-3">{{ $users->firstItem() + $index }}</td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->username }}</td>
                            <td class="p-3">{{ ucfirst($user->role->name) }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="text-blue-600 inline-flex items-center gap-1 hover:underline">
                                   <i class="fas fa-pen"></i>
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('users.destroy', $user->id) }}"
                                      onsubmit="return confirm('Yakin hapus user?')">
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
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->links() }}

    </div>

    

    

</x-dashboard.layout>
