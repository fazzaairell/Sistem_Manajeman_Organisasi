<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi user baru
     * Semua user yang daftar otomatis menjadi mahasiswa
     */
    public function register(Request $request)
    {
        // Validasi input dengan pesan error dalam Bahasa Indonesia
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'min:4', 'unique:users', 'alpha_dash'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.min' => 'Nama lengkap minimal 3 karakter.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',

            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.min' => 'Username minimal 4 karakter.',
            'username.max' => 'Username maksimal 255 karakter.',
            'username.unique' => 'Username sudah digunakan, pilih username lain.',
            'username.alpha_dash' => 'Username hanya boleh mengandung huruf, angka, dash dan underscore.',
            
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.regex' => 'Kata sandi harus mengandung huruf besar, huruf kecil, dan angka.',
        ]);

        // Ambil role mahasiswa
        $roleMahasiswa = Role::where('name', 'mahasiswa')->first();

        // Buat user baru dengan role mahasiswa
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role_id' => $roleMahasiswa->id,
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }
}
