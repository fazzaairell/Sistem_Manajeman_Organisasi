@props(['newUsers', 'announcements'])

<div class="space-y-6">
    <!-- Pengumuman Terbaru -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b flex items-center justify-between border-gray-300/40">
            <h3 class="text-lg font-semibold text-gray-800">Pengumuman Terbaru</h3>
            <a href="{{ route('announcements.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($announcements as $announcement)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-bullhorn text-yellow-600"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800 font-medium line-clamp-2">{{ $announcement->content }}</p>
                            <span class="text-xs text-gray-500 mt-1 block">{{ \Carbon\Carbon::parse($announcement->date)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">Belum ada pengumuman.</div>
            @endforelse
        </div>
    </div>

    <!-- Anggota Baru -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b flex items-center justify-between border-gray-300/40">
            <h3 class="text-lg font-semibold text-gray-800">Anggota Baru</h3>
            <a href="{{ route('users.index') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($newUsers as $user)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $user->photo ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                             alt="{{ $user->name }}" 
                             class="w-10 h-10 rounded-full object-cover border border-gray-200">
                        <div class="flex-1">
                            <p class="text-sm text-gray-800 font-medium">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
               <div class="p-6 text-center text-gray-500 text-sm">Belum ada anggota baru.</div>
            @endforelse
        </div>
    </div>
</div>