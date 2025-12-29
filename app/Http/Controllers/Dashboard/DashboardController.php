<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        $totalAnggota = User::where('role_id', '!=', 1)->count();

        $eventAktif = Event::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->count();

        $eventMendatang = Event::whereDate('start_date', '>', now())->count();

        $pengumumanHariIni = Announcement::whereDate('date', now())->count();

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif',
            'eventMendatang',
            'pengumumanHariIni'
        ));
    }
}

