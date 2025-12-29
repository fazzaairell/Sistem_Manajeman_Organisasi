<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $event->registrations()->create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

}
