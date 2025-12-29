<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Announcement;


class HomepageController extends Controller
{
    public function index(){
        $events = Event::latest()->take(3)->get();
        $announcements = Announcement::latest()->take(6)->get();
        return view('homepage.index', compact('events', 'announcements'));
    }
}
