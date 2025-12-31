<x-dashboard.layout title="Edit Event">

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">

        <!-- Header Section -->
        <div class="flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    Edit Event
                </h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi event</p>
            </div>
            <a href="{{ route('events.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Judul Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-blue-500 mr-1"></i>
                        Judul Event <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Masukkan judul event" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-toggle-on text-blue-500 mr-1"></i>
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option value="mendatang" {{ old('status', $event->status) == 'mendatang' ? 'selected' : '' }}>
                            Mendatang</option>
                        <option value="aktif" {{ old('status', $event->status) == 'aktif' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="selesai" {{ old('status', $event->status) == 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Penanggung Jawab -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-tie text-blue-500 mr-1"></i>
                        Penanggung Jawab <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="penanggung_jawab"
                        value="{{ old('penanggung_jawab', $event->penanggung_jawab) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Nama penanggung jawab" required>
                    @error('penanggung_jawab')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div x-data="{
                                start_date: '{{ old('start_date', $event->start_date) }}',
                                end_date: '{{ old('end_date', $event->end_date) }}',
                                updating: false,
                                async updateDate() {
                                    this.updating = true;
                                    try {
                                        const res = await fetch('{{ route("api.events.update-date", $event->id) }}', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                start_date: this.start_date,
                                                end_date: this.end_date
                                            })
                                        });
                                        const data = await res.json();
                                        if (!res.ok) throw data;
                                        alert('Tanggal berhasil diperbarui!');
                                    } catch (err) {
                                        alert('Error: ' + (err.message || 'Validasi gagal'));
                                    } finally {
                                        this.updating = false;
                                    }
                                }
                            }" class="space-y-4 grid grid-cols-2 gap-4">

                    <!-- Tanggal Mulai -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-check text-blue-500 mr-1"></i>
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" x-model="start_date" @change="updateDate()"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            required>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar-times text-blue-500 mr-1"></i>
                            Tanggal Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" x-model="end_date" @change="updateDate()"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            required>
                    </div>

                    <!-- Updating indicator -->
                    <div x-show="updating" class="text-blue-500 text-sm">Updating...</div>
                </div>






                <!-- Deskripsi Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-blue-500 mr-1"></i>
                        Deskripsi Event <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Deskripsi lengkap event"
                        required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Gambar Event (full width) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-image text-blue-500 mr-1"></i>
                        Gambar Event <span class="text-gray-400">(Opsional)</span>
                    </label>
                    @if($event->image)
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-2">Gambar Saat Ini:</p>
                            <img src="{{ filter_var($event->image, FILTER_VALIDATE_URL) ? $event->image : asset('storage/' . $event->image) }}"
                                class="h-32 w-48 object-cover rounded-xl border-2 border-gray-200" id="current-preview">
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500
                                   file:mr-4 file:py-3 file:px-4
                                   file:rounded-xl file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-gradient-to-r file:from-blue-50 file:to-blue-100
                                   file:text-blue-700
                                   hover:file:from-blue-100 hover:file:to-blue-200
                                   file:cursor-pointer file:transition-all
                                   border border-gray-200 rounded-xl
                                   focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="previewImage(event)">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        JPG, PNG • Maksimal 2MB • Kosongkan jika tidak ingin mengubah gambar
                    </p>
                    <div id="preview" class="hidden mt-3">
                        <p class="text-xs text-gray-500 mb-2">Preview Gambar Baru:</p>
                        <img id="preview-img" class="h-32 w-48 object-cover rounded-xl border-2 border-blue-200">
                    </div>
                    @error('image')
                        <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('events.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors">
                    <i class="fas fa-times text-sm"></i>
                    <span>Batal</span>
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-save text-sm"></i>
                    <span>Update Event</span>
                </button>
            </div>
        </form>

    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewImg = document.getElementById('preview-img');
            const currentPreview = document.getElementById('current-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (currentPreview) currentPreview.style.opacity = '0.5';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-dashboard.layout>