<x-dashboard.layout title="Manajemen User">

    <div class="bg-white shadow-sm p-6 space-y-6 p-10">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Manajemen User</h1>

            <div class="flex gap-2">
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah User</span>
                </a>

                <a href="{{ route('users.export-pdf') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    Export PDF
                </a>
            </div>
        </div>

        <form method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau username..."
                class="border rounded-lg px-3 py-2 text-sm w-64">

            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm">
                Cari
            </button>
        </form>

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
                                <button data-modal-target="edit-event-{{ $user->id }}"
                                    data-modal-toggle="edit-event-{{ $user->id }}"
                                    class="text-blue-600 hover:underline inline-flex items-center gap-1">
                                    <i class="fas fa-pen-to-square text-lg"></i>
                                </button>
                                <div id="edit-event-{{ $user->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                    <div class="relative w-full max-w-xl p-4">
                                        <div class="bg-white rounded-xl shadow-lg p-6">

                                            <div class="flex justify-between items-center border-b border-gray-300/40 pb-3">
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    Ubah Data Event
                                                </h3>
                                                <button data-modal-hide="edit-event-{{ $user->id }}"
                                                    class="text-gray-400 hover:text-gray-600">  
                                                    ✕
                                                </button>
                                            </div>

                                            <form action="{{ route('users.update', $user->id) }}" method="POST"
                                                enctype="multipart/form-data" class="space-y-4 pt-4">
                                                @csrf
                                                @method('PUT')

                                                <div>
                                                    <label class="text-sm font-medium">User</label>
                                                    <input type="text" name="name" value="{{ $user->name }}"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Email</label>
                                                    <input type="email" name="email" value="{{ $user->email }}"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Role</label>
                                                    <select name="role_id"
                                                        class="w-full rounded-lg border-gray-300 focus:outline-none"
                                                        required>
                                                        <option value="">----Pilih Opsi----</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="text-sm font-medium">Foto User</label>
                                                    @if($user->image)
                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                            class="w-24 mb-2 rounded-lg">
                                                    @endif
                                                    <input type="file" name="image"
                                                        class="w-full text-sm focus:outline-none">
                                                </div>

                                                <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                                                    <button type="button" data-modal-hide="edit-event-{{ $user->id }}"
                                                        class="px-4 py-2 bg-gray-100 rounded-lg">
                                                        Batal
                                                    </button>
                                                    <button type="submit"
                                                        class="px-5 py-2 bg-blue-500 text-white rounded-lg">
                                                        Update
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                    onsubmit="return confirm('Yakin hapus user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center gap-1 text-red-600 hover:underline">
                                        <i class="fas fa-trash text-lg"></i>
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