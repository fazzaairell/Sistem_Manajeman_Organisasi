<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementHomeController extends Controller
{
    public function index()
    {
        // Ambil hanya pengumuman yang published dan aktif
        $announcements = Announcement::published()
            ->active()
            ->latest('date')
            ->paginate(9);

        return view('homepage.announcements.announcements', compact('announcements'));
    }

}
