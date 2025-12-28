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
        if (!Auth::check()) {
            abort(403);
        }

        $user = Auth::user();

        if ($user->role_id !== 1) {
            abort(403);
        }

        // Total anggota (selain admin)
        $totalAnggota = User::where('role_id', '!=', 1)->count();

        // Event aktif (sedang berlangsung hari ini)
        $eventAktif = Event::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        // Pengumuman hari ini (pakai kolom 'date')
        $pengumumanHariIni = Announcement::whereDate('date', now())->count();

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif',
            'pengumumanHariIni'
        ));
    }
}
