<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LayananPublikController;
use App\Http\Controllers\GaleriPublikController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\GaleriController;

// Halaman publik (Guest)
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('layanan', [LayananPublikController::class, 'index'])->name('layanan');
Route::get('galeri', [GaleriPublikController::class, 'index'])->name('galeri');

// Route login & registrasi (hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.proses');

    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.proses');

    // Lupa password (nama route password.* dibutuhkan oleh Laravel untuk email reset)
    Route::get('forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Route logout (harus sudah login)
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Route khusus pelanggan
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'pelanggan'])->name('dashboard');
});

// Route khusus admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // CRUD layanan (menghasilkan route admin.layanan.index, create, store, edit, update, destroy)
    Route::resource('layanan', LayananController::class)->except('show');

    // CRUD galeri
    Route::resource('galeri', GaleriController::class)->except('show');
});
