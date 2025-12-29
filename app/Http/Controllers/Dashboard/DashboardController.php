<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard setelah login
     */
    public function index()
    {

        if (auth()->user()->role_id != 1) {
            abort(403);
        }
        return view('dashboard.index');
    }
}
