<?php

namespace App\Http\Controllers;

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

        // ===== AKTIVITAS TERBARU =====
        $aktivitas = collect();

        // User baru
        $users = User::latest()->take(3)->get()->map(function ($u) {
            return [
                'type' => 'user',
                'title' => 'Anggota Baru',
                'desc' => $u->name . ' bergabung',
                'time' => $u->created_at,
            ];
        });

        // Event baru
        $events = Event::latest()->take(3)->get()->map(function ($e) {
            return [
                'type' => 'event',
                'title' => $e->title,
                'desc' => 'Event baru ditambahkan',
                'time' => $e->created_at,
            ];
        });

        // Pengumuman baru
        $announcements = Announcement::latest()->take(3)->get()->map(function ($a) {
            return [
                'type' => 'announcement',
                'title' => 'Pengumuman',
                'desc' => Str::limit($a->content, 40),
                'time' => $a->created_at,
            ];
        });

        $aktivitas = $aktivitas
            ->merge($users)
            ->merge($events)
            ->merge($announcements)
            ->sortByDesc('time')
            ->take(5);

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif',
            'pengumumanHariIni',
            'eventMendatang',
            'aktivitas'
        ));
    }
    
}
