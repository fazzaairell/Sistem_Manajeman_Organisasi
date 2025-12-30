<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Gallery;


class HomepageController extends Controller
{
    public function index(){
        // Mengambil 6 event terbaru yang statusnya mendatang atau aktif
        $events = Event::whereIn('status', ['mendatang', 'aktif'])
            ->latest()
            ->take(6)
            ->get();
        
        // Ambil 6 pengumuman yang published dan aktif
        $announcements = Announcement::published()
            ->active()
            ->latest('date')
            ->take(6)
            ->get();
        
        // Ambil 6 galeri terbaru
        $galleries = Gallery::latest()
            ->take(6)
            ->get();
        
        return view('homepage.index', compact('events', 'announcements', 'galleries'));
    }
}
