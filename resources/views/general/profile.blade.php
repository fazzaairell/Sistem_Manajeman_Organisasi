<x-dashboard.layout>
    <div class="max-w-6xl mx-auto px-4 py-6">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">
            Profil Saya
        </h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow p-6 md:col-span-1">
                <div class="flex flex-col items-center text-center">

                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                            class="h-28 w-28 rounded-full object-cover border mb-4">
                    @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-4">
                            <i class="fas fa-user text-4xl"></i>
                        </div>
                    @endif

                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ auth()->user()->email }}
                    </p>



                    <!-- Modal toggle -->
                    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                        class="mt-3 inline-block px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700"
                        type="button">
                        Ganti Password
                    </button>

                    <!-- Main modal -->
                    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div
                                class="relative bg-neutral-primary-soft border border-gray-300/40 rounded-base shadow-sm p-4 md:p-6 bg-white">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between border-b border-gray-300/40 pb-4 md:pb-5">
                                    <h3 class="text-lg font-medium text-heading">
                                        Change Password
                                    </h3>
                                    <button type="button"
                                        class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="authentication-modal">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form method="POST" action="{{ route('general.change-password') }}" class="pt-4 md:pt-6">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="current_password"
                                            class="block mb-2.5 text-sm font-medium text-heading">Current
                                            Password</label>
                                        <input type="password" id="current_password" name="current_password"
                                            class="bg-neutral-secondary-medium border border-gray-300/40 text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                            placeholder="•••••••••" required />
                                        @error('current_password')
                                            <p><strong>{{ $message }}</strong></p>
                                        @enderror

                                    </div>
                                    <div>
                                        <label for="new_password"
                                            class="block mb-2.5 text-sm font-medium text-heading">New
                                            password</label>
                                        <input type="password" id="new_password" name="new_password"
                                            class="bg-neutral-secondary-medium border border-gray-300/40 text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                            placeholder="•••••••••" required />
                                        @error('new_password')
                                            <p><strong>{{ $message }}</strong></p>
                                        @enderror
                                        <p class="text-red-400"><small>Minimal 8 karakter, harus ada huruf besar dan
                                                huruf kecil</small></p>

                                    </div>
                                    <div>
                                        <label for="new_password_confirmation"
                                            class="block mb-2.5 text-sm font-medium text-heading mt-2">Confirmation
                                            password</label>
                                        <input type="password" id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            class="bg-neutral-secondary-medium border border-gray-300/40 text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                                            placeholder="•••••••••" required />
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-blue-500 rounded-lg mt-6 hover:bg-blue-600 box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none w-full mb-3">Login
                                        to your account</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <a class="mt-3 inline-block px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                        {{ auth()->user()->jabatan ?? 'Belum ada jabatan' }}
                    </a>

                    <div class="w-full border-t border-gray-300/40 my-4"></div>

                    <div class="w-full text-left text-sm space-y-2">
                        <p><strong>NRP:</strong> {{ auth()->user()->nrp ?? '-' }}</p>
                        <p><strong>Jurusan:</strong> {{ auth()->user()->jurusan ?? '-' }}</p>
                        <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
                <form method="POST" action="{{ route('general.update') }}" enctype="multipart/form-data"
                    class="space-y-4">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 w-full rounded-md border-gray-300 border
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}"
                                class="mt-1 w-full rounded-md border-gray-300 border
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 w-full rounded-md border-gray-300 border
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Jabatan
                            </label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', auth()->user()->jabatan) }}"
                                class="mt-1 w-full rounded-md border-gray-300 border">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                NRP
                            </label>
                            <input type="text" name="nrp" value="{{ old('nrp', auth()->user()->nrp) }}"
                                class="mt-1 w-full rounded-md border-gray-300 border">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Jurusan
                            </label>
                            <input type="text" name="jurusan" value="{{ old('jurusan', auth()->user()->jurusan) }}"
                                class="mt-1 w-full rounded-md border-gray-300 border">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Foto Profil
                            </label>
                            <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:bg-indigo-50 file:text-indigo-700
                                          hover:file:bg-indigo-100">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-300/40">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-dashboard.layout>