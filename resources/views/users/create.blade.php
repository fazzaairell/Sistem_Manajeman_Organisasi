<x-dashboard.layout title="Tambah User">

    
    <div class="bg-white shadow-sm p-6 space-y-6 p-10">

        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Tambahkan User Baru</h1>

            <div class="flex gap-2">
                <a href="{{ route('users.create') }}"  
                   class="inline-flex items-center gap-2 px-3 py-2 bg-purple-500 text-white rounded-lg text-sm hover:bg-purple-600">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah User</span>
                </a>

                <a href="{{ route('users.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200">
                    Back
                </a>
            </div>
        </div>

    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label for="name">Nama Lengkap:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>

        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
                <p><strong>{{ $message }}</strong></p>
            @enderror
            <p><small>Minimal 8 karakter, harus ada huruf besar dan huruf kecil</small></p>
        </div>
        
        <br>
        
        <div>
            <label for="password_confirmation">Konfirmasi Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        
        <br>
        
        <div>
            <label for="role_id">Role:</label><br>
            <select id="role_id" name="role_id" required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <p><strong>{{ $message }}</strong></p>
            @enderror
        </div>
        
        <br>
        
        <div>
            <label for="photo">Foto Profile (Opsional):</label><br>
            <input type="file" id="photo" name="photo" accept="image/*">
            @error('photo')
                <p><strong>{{ $message }}</strong></p>
            @enderror
            <p><small>Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small></p>
        </div>
        
        <br>
        
        <div>
            <button type="submit">Simpan</button>
            <a href="{{ route('users.index') }}"><button type="button">Batal</button></a>
        </div>
    </form>
        

    </div>
</x-dashboard.layout>
