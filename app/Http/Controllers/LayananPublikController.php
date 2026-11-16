<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananPublikController extends Controller
{
    // Halaman Layanan untuk pengunjung. Datanya dikelola admin di menu Kelola Layanan.
    public function index(Request $request)
    {
        $kategori = ['Manicure & Pedicure', 'Facial Glow', 'Make Up', 'Penataan Rambut'];

        // Hanya layanan yang berstatus aktif
        $data = Layanan::aktif()
            ->filter($request, ['kategori'])
            ->search($request, ['nama_layanan', 'deskripsi'])
            ->orderBy('id_layanan')
            ->paginate(6)
            ->withQueryString();

        return view('guest.layanan', compact('data', 'kategori'));
    }
}
