<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
{
    // Mengambil Semua Pengumuman Terbaru
    $announcements = Announcement::latest()->get();
    
    return view('announcements.index', compact('announcements'));
}

    // Simpan Pengumuman Baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'content' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        Announcement::create($data);
        return back()->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    // Hapus Pengumuman
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }
        
        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus!');
    }

    // Fungsi Menampilkan Halaman Form Edit
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement'));
    }

    // Fungsi Pembaruan Data
    public function update(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date' => 'required|date',
            'content' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($announcement->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($announcement->image);
            }
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }
    
}