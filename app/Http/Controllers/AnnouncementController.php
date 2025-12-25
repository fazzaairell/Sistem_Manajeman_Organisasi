<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        // Mengambil semua pengumuman untuk ditampilkan di dashboard
        $announcements = Announcement::all();
        return view('dashboard.announcements', compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'date' => 'required|date',
            'content' => 'required',
        ]);

        $path = $request->file('image')->store('announcements', 'public');

        Announcement::create([
            'image' => $path,
            'date' => $request->date,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil terbit!');
    }
}
