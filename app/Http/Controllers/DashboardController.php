<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan user login
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        // Hanya admin yang boleh akses dashboard
        if ($user->role_id !== 1) {
            abort(403);
        }

        // Total anggota (selain admin)
        $totalAnggota = User::where('role_id', '!=', 1)->count();

        // Event aktif
        $eventAktif = Event::where('status', 'aktif')->count();

        // Pengumuman hari ini
        $pengumumanHariIni = Announcement::whereDate('created_at', now())->count();

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif',
            'pengumumanHariIni'
        ));
    }
}
