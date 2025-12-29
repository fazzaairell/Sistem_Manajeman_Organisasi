<x-dashboard.layout title="Tambah Event">

    <div class="bg-white shadow-sm p-10 space-y-6">

        <h1 class="text-xl font-semibold text-gray-800 border-b py-3 border-gray-300/40">
            Tambahkan Event Baru
        </h1>

        <form method="POST"
              action="{{ route('events.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Event
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                           placeholder="Masukkan judul event"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>
                    <select name="status"
                            class="w-fit rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                            required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Mulai
                    </label>
                    <input type="date"
                           name="start_date"
                           value="{{ old('start_date') }}"
                           class="w-fit rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                           required>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Selesai
                    </label>
                    <input type="date"
                           name="end_date"
                           value="{{ old('end_date') }}"
                           class="w-fit rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                           required>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Penanggung Jawab
                    </label>
                    <input type="text"
                           name="penanggung_jawab"
                           value="{{ old('penanggung_jawab') }}"
                           class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                           placeholder="Nama penanggung jawab"
                           required>
                    @error('penanggung_jawab')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar Event (Opsional)
                    </label>
                    <input type="file"
                           name="image"
                           accept="image/*"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-purple-50 file:text-purple-700
                                  hover:file:bg-purple-100">
                    <p class="mt-1 text-xs text-gray-500">
                        JPG, PNG • Maks 2MB
                    </p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Event
                    </label>
                    <textarea name="description"
                              rows="4"
                              class="w-full rounded-lg border-gray-300 focus:outline-none focus:border-purple-500 focus:ring-purple-500"
                              placeholder="Deskripsi lengkap event"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-300/40">
                <a href="{{ route('events.index') }}"
                   class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                    Simpan Event
                </button>
            </div>

        </form>

    </div>

</x-dashboard.layout>
