<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role_id !== 1) {
            abort(403);
        }

        // ===== STATISTIK =====
        $totalAnggota = User::where('role_id', '!=', 1)->count();
        $eventAktif = Event::where('status', 'Aktif')->count();
        $pengumumanHariIni = Announcement::whereDate('created_at', now())->count();
        $eventMendatang = Event::where('status', 'Mendatang')->count();


        // ===== DATA TERBARU =====
        $newUsers = User::where('role_id', '!=', 1)->latest()->limit(5)->get();
        $upcomingEvents = Event::where('status', 'Mendatang')->orderBy('start_date', 'asc')->limit(3)->get();
        $recentAnnouncements = Announcement::latest()->limit(3)->get();

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif',
            'pengumumanHariIni',
            'eventMendatang',
            'newUsers',
            'upcomingEvents',
            'recentAnnouncements'
        ));
    }

}
