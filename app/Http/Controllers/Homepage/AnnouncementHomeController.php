<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementHomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->take(6)->get();

        return view('homepage.announcements.announcements', compact('announcements'));
    }

}
