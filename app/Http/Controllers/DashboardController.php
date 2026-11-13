<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard admin (diisi lengkap di Tahap 3)
    public function admin()
    {
        return view('admin.dashboard');
    }

    // Dashboard pelanggan (diisi lengkap di Tahap 6)
    public function pelanggan()
    {
        return view('pelanggan.dashboard');
    }
}
