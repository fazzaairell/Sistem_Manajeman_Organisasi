<x-dashboard.layout title="Manajemen User">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6" 
         x-data="{ 
             search: '{{ request('search') }}',
             loading: false,
             
             async searchUsers() {
                 this.loading = true;
                 try {
                     const response = await fetch(`{{ route('users.index') }}?search=${this.search}`, {
                         headers: {
                             'X-Requested-With': 'XMLHttpRequest',
                             'Accept': 'application/json'
                         }
                     });
                     const html = await response.text();
                     const parser = new DOMParser();
                     const doc = parser.parseFromString(html, 'text/html');
                     const tbody = doc.querySelector('tbody');
                     document.querySelector('tbody').innerHTML = tbody.innerHTML;
                 } catch (error) {
                     console.error('Error:', error);
                 } finally {
                     this.loading = false;
                 }
             }
         }"
    >

        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                    Manajemen User
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola semua pengguna sistem</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('users.export-pdf', ['search' => request('search')]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-green-500/30">
                    <i class="fas fa-file-pdf"></i>
                    <span>Export PDF</span>
                </a>
                <a href="{{ route('users.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-purple-500/30">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah User</span>
                </a>
            </div>
        </div>

        <!-- Search Bar with Live Search -->
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input 
                type="text" 
                x-model="search"
                x-on:input.debounce.300ms="searchUsers()"
                placeholder="Cari nama, username, atau email..."
                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
            >
            <div x-show="loading" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                <svg class="animate-spin h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NRP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $index => $user)
                        <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                            <td class="px-6 py-4 text-gray-600">
                                {{ $users->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        @php
                                            $nameParts = explode(' ', $user->name);
                                            $initials = '';
                                            if (count($nameParts) >= 2) {
                                                $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                                            } else {
                                                $initials = strtoupper(substr($user->name, 0, 2));
                                            }
                                        @endphp
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-semibold text-sm">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->jurusan ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->username }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $user->nrp ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                @if($user->role->name === 'Admin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-shield-halved"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                        <i class="fas fa-user"></i>
                                        Mahasiswa
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="w-9 h-9 inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-pen text-sm"></i>
                                    </a>
                                    <button 
                                        @click="$dispatch('open-delete-modal-user-{{ $user->id }}')"
                                        type="button"
                                        class="w-9 h-9 inline-flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-all duration-200 hover:scale-110">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>

                                    <!-- Delete Form (Hidden) -->
                                    <div x-data="{ deleteForm: null }"
                                         @confirm-delete-user-{{ $user->id }}.window="deleteForm = $refs.deleteForm{{ $user->id }}; deleteForm.submit()">
                                        <form ref="deleteForm{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <x-dashboard.delete-modal
                            id="user-{{ $user->id }}"
                            title="Hapus User?"
                            message="Apakah Anda yakin ingin menghapus user '{{ $user->name }}'? Tindakan ini tidak dapat dibatalkan."
                        />
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <i class="fas fa-users-slash text-5xl mb-3"></i>
                                    <p class="text-sm font-medium">Tidak ada data user</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="border-t border-gray-200 pt-4">
            {{ $users->links() }}
        </div>

    </div>

</x-dashboard.layout>
