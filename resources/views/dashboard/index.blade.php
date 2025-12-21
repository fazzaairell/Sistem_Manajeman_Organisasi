<x-dashboard.layout title="Dashboard">
    <div id="dashboard" class="p-8">
        <x-dashboard.dashboard-card>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Anggota</p>
                        <h3 class="text-3xl font-bold text-gray-800">48</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-3">
                    <i class="fas fa-arrow-up"></i> +12% dari bulan lalu
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Event Aktif</p>
                        <h3 class="text-3xl font-bold text-gray-800">12</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-project-diagram text-purple-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-3">
                    <i class="fas fa-arrow-up"></i> 3 Event baru minggu ini
                </p>
            </div>


            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Pengumuman Hari Ini</p>
                        <h3 class="text-3xl font-bold text-gray-800">24</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tasks text-yellow-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">
                    <span class="text-green-600 font-medium">2 selesai</span> • 1 berlangsung
                </p>
            </div>


            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Event Mendatang</p>
                        <h3 class="text-3xl font-bold text-gray-800">5</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-orange-600 mt-3">
                    <i class="fas fa-clock"></i> Terdekat: Besok 09:00
                </p>
            </div>


        </x-dashboard.dashboard-card>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-dashboard.dasboard-activities />
            <x-dashboard.dasboard-coming />
        </div>
    </div>

</x-dashboard.layout>