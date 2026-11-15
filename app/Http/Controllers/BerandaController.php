<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Ulasan;

class BerandaController extends Controller
{
    // Halaman Beranda (Guest). Semua datanya diambil dari database.
    public function index()
    {
        // 4 layanan aktif untuk bagian "Layanan unggulan"
        $layanan = Layanan::aktif()->orderBy('id_layanan')->take(4)->get();

        // 3 foto galeri pertama yang berstatus tampil
        $galeri = Galeri::tampil()->orderBy('id_galeri')->take(3)->get();

        // 3 ulasan terbaru yang boleh tampil. 
        $ulasan = Ulasan::tampil()
            ->with(['user', 'reservasi.layanan'])
            ->latest('tanggal_ulasan')
            ->take(3)
            ->get();

        // Ringkasan rating untuk bagian hero
        $jumlahUlasan = Ulasan::tampil()->count();
        $rataRating   = Ulasan::tampil()->avg('rating');

        return view('guest.beranda', compact('layanan', 'galeri', 'ulasan', 'jumlahUlasan', 'rataRating'));
    }
}
