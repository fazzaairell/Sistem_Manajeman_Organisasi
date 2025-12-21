<div class="p-8 hidden" id="profil">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Profil Organisasi</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola profil organisasi</p>
        </div>

        <!-- Organization Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Organisasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Bidang Usaha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">1</td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-gray-900">Tech Innovation Hub</p>
                            <p class="text-xs text-gray-500">Direktur: John Doe</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">Teknologi Informasi</td>
                        <td class="px-6 py-4 text-sm text-gray-600">Jl. Teknologi No. 123</td>
                        <td class="px-6 py-4">
                            <button onclick="openModal()" class="text-green-600 hover:text-green-800 mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t">
            <button onclick="openModal()"
                class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Profil Organisasi
            </button>
        </div>
    </div>
</div>