<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class GeneralController extends Controller
{
    public function index()
    {
        return view('general.profile');
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'nullable|string|max:255',
            'nrp' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($data);

        return redirect()
            ->back()
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function changePassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
                'different:current_password'
            ],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',

            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.regex' => 'Password baru harus mengandung huruf besar dan huruf kecil.',
            'new_password.different' => 'Password baru harus berbeda dengan password saat ini.',
        ]);

        $user = Auth::user();

        // Cek apakah password saat ini benar
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.',
            ]);
        }

        // Update password
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }

}
