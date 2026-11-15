<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard admin 
    public function admin()
    {
        return view('admin.dashboard');
    }

    // Dashboard pelanggan 
    public function pelanggan()
    {
        return view('pelanggan.dashboard');
    }
}
