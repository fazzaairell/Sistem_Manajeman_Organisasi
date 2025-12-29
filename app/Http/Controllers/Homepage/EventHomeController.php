<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventHomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(6);
        return view('homepage.events.events', compact('events'));
    }
}
