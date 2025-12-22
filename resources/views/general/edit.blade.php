<x-dashboard.layout>
    <div class="max-w-5xl mx-auto px-4 py-6">

        <h1 class="text-2xl font-semibold text-gray-800 mb-6">
            Profil Organisasi
        </h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST"
                  action="{{ route('general.organization.update') }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Nama & Singkatan --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Nama Organisasi
                        </label>
                        <input type="text" name="name"
                               value="{{ old('name', $organization->name ?? '') }}"
                               class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Singkatan
                        </label>
                        <input type="text" name="short_name"
                               value="{{ old('short_name', $organization->short_name ?? '') }}"
                               class="mt-1 w-full rounded-md border-gray-300 border">
                    </div>
                </div>

                {{-- Logo --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Logo Organisasi
                    </label>

                    @if(!empty($organization->logo))
                        <img src="{{ asset('storage/'.$organization->logo) }}"
                             class="h-20 mb-2 rounded">
                    @endif

                    <input type="file" name="logo"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                </div>

                {{-- Alamat --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Alamat Lengkap
                    </label>
                    <textarea name="address" rows="3"
                              class="mt-1 w-full rounded-md border-gray-300 border">{{ old('address', $organization->address ?? '') }}</textarea>
                </div>

                {{-- Kontak --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" name="email"
                               value="{{ old('email', $organization->email ?? '') }}"
                               class="mt-1 w-full rounded-md border-gray-300 border">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone"
                               value="{{ old('phone', $organization->phone ?? '') }}"
                               class="mt-1 w-full rounded-md border-gray-300 border">
                    </div>
                </div>

                {{-- Website & Tahun --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Website
                        </label>
                        <input type="url" name="website"
                               value="{{ old('website', $organization->website ?? '') }}"
                               class="mt-1 w-full rounded-md border-gray-300 border">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Tahun Berdiri
                        </label>
                        <input type="number" name="founded_year"
                               value="{{ old('founded_year', $organization->founded_year ?? '') }}"
                               class="mt-1 w-full rounded-md border-gray-300 border">
                    </div>
                </div>

                {{-- Button --}}
                <div class="flex justify-end">
                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
