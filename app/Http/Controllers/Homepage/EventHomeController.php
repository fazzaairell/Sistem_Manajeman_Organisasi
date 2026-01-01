<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventHomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(6);
        return view('homepage.events.events', compact('events'));
    }

    public function show(Event $event)
    {
        return view('homepage.events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        // pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk mendaftar event.');
        }

        // cegah daftar dua kali
        $alreadyRegistered = $event->registrations()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->back()
                ->with('error', 'Anda sudah terdaftar pada event ini.');
        }

        // simpan pendaftaran
        $event->registrations()->create([
            'user_id'       => Auth::id(),
            'status'        => 'pending',
            'registered_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pendaftaran event berhasil!');
    }
}
