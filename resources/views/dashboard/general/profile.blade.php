<x-dashboard.layout>
    <div class="p-6 space-y-6" x-data="{ showPasswordModal: false }">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pengaturan Profil</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2 animate-fade-in-down">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Profile Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="h-32 bg-gradient-to-r from-purple-500 to-indigo-600 relative">
                        <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                            <div class="relative">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" 
                                         class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md">
                                @else
                                    <div class="w-24 h-24 rounded-full border-4 border-white bg-gray-100 flex items-center justify-center shadow-md text-gray-400">
                                        <i class="fas fa-user text-4xl"></i>
                                    </div>
                                @endif
                                <button class="absolute bottom-0 right-0 bg-white p-1.5 rounded-full shadow-sm border border-gray-200 text-gray-500 hover:text-indigo-600 transition"
                                        title="Ubah Foto"
                                        onclick="document.getElementById('photoInput').click()">
                                    <i class="fas fa-camera text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-16 pb-6 px-6 text-center space-y-3">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        
                        <div class="flex flex-wrap justify-center gap-2">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-semibold rounded-full border border-indigo-100">
                                {{ auth()->user()->username }}
                            </span>
                            @if(auth()->user()->jabatan)
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 text-xs font-semibold rounded-full border border-purple-100">
                                    {{ auth()->user()->jabatan }}
                                </span>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-50 grid grid-cols-2 gap-4 text-left">
                            <div class="bg-gray-50 p-3 rounded-xl">
                                <span class="text-xs text-gray-400 block uppercase font-bold tracking-wider">NRP / NPM</span>
                                <span class="text-sm font-semibold text-gray-700 block mt-1">{{ auth()->user()->nrp ?? '-' }}</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-xl">
                                <span class="text-xs text-gray-400 block uppercase font-bold tracking-wider">Jurusan</span>
                                <span class="text-sm font-semibold text-gray-700 block mt-1">{{ auth()->user()->jurusan ?? '-' }}</span>
                            </div>
                        </div>

                        <button @click="showPasswordModal = true" 
                                class="w-full mt-4 py-2.5 px-4 bg-white border border-gray-200 text-gray-600 rounded-xl font-medium text-sm hover:bg-gray-50 hover:text-indigo-600 hover:border-indigo-200 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i>
                            Ganti Kata Sandi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Edit Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
                        <span class="text-xs text-gray-400 italic">Perbarui informasi data diri Anda</span>
                    </div>

                    <form method="POST" action="{{ route('general.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Hidden Photo Input triggered by camera icon -->
                        <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-user text-sm"></i>
                                    </span>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" 
                                           placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>

                            <!-- Username -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-at text-sm"></i>
                                    </span>
                                    <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" 
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm" 
                                           required>
                                </div>
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-briefcase text-sm"></i>
                                    </span>
                                    <input type="text" name="jabatan" value="{{ old('jabatan', auth()->user()->jabatan) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm"
                                           placeholder="Contoh: Staff IT">
                                </div>
                            </div>

                            <!-- NRP / NPM -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">NPM / NRP</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-id-card text-sm"></i>
                                    </span>
                                    <input type="text" name="nrp" value="{{ old('nrp', auth()->user()->nrp) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm"
                                           placeholder="Nomor Induk Mahasiswa">
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-graduation-cap text-sm"></i>
                                    </span>
                                    <input type="text" name="jurusan" value="{{ old('jurusan', auth()->user()->jurusan) }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm"
                                           placeholder="Contoh: Teknik Informatika">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-8 mt-4 border-t border-gray-50">
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-medium shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transform hover:-translate-y-0.5 transition-all text-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Modal (Enhanced) -->
        <div x-show="showPasswordModal" 
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            
            <!-- Backdrop -->
            <div x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                 @click="showPasswordModal = false"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <!-- Modal Panel -->
                <div x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                    
                    <!-- Colorful Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-6 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm mb-4 ring-4 ring-white/10">
                            <i class="fas fa-lock text-3xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold leading-6 text-white" id="modal-title">Ganti Kata Sandi</h3>
                        <p class="text-sm text-indigo-100 mt-1">Amankan akun Anda dengan kata sandi baru.</p>
                    </div>

                    <div class="px-6 py-6">
                        <form id="passwordForm" method="POST" action="{{ route('general.change-password') }}" class="space-y-5">
                            @csrf
                            @method('PUT')
                            
                            <!-- Current Password -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-key"></i>
                                    </span>
                                    <input type="password" name="current_password" required 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm placeholder:text-gray-300"
                                           placeholder="••••••••">
                                </div>
                                @error('current_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="new_password" required 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm placeholder:text-gray-300"
                                           placeholder="••••••••">
                                </div>
                                 @error('new_password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    <input type="password" name="new_password_confirmation" required 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all text-sm placeholder:text-gray-300"
                                           placeholder="••••••••">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-gray-100">
                        <button type="button" @click="showPasswordModal = false" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm font-medium hover:bg-gray-50 hover:text-gray-900 transition-colors shadow-sm">
                            Batal
                        </button>
                        <button type="submit" form="passwordForm" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-xl text-white text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-lg shadow-indigo-200 transition-all">
                            Simpan Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.layout>