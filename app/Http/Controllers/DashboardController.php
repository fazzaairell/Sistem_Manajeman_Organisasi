<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
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
        $eventAktif   = Event::where('status', 'aktif')->count();

        return view('dashboard.index', compact(
            'totalAnggota',
            'eventAktif'
        ));
    }
}
