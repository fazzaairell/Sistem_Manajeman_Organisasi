<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Menampilkan semua event di halaman
    public function index()
    {
        $events = Event::all();
        return view('dashboard.events', compact('events'));
    }

    // Menyimpan data event baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Mengunggah gambar ke folder storage/app/public/events
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
        }

        Event::create([
            'user_id' => $request->user()->id, // Mengambil ID user yang sedang login
            'image' => $path,
            'status' => $request->status ?? 'Akan Datang',
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Event berhasil ditambahkan!');
    }
}