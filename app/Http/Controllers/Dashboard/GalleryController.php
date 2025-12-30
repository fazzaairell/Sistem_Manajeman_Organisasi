<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller {
    public function index() {
        $galleries = Gallery::latest()->get();
        return view('dashboard.gallery.index', compact('galleries'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Gambar berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery) {
        return view('dashboard.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($gallery->image);
            // Upload gambar baru
            $gallery->image = $request->file('image')->store('gallery', 'public');
        }

        $gallery->title = $request->title;
        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Gambar diperbarui.');
    }

    public function destroy(Gallery $gallery) {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Gambar dihapus.');
    }
}