<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriPublikController extends Controller
{
    // Halaman Galeri untuk pengunjung. Fotonya dikelola admin di menu Galeri.
    public function index(Request $request)
    {
        $kategori = ['Manicure & Pedicure', 'Facial Glow', 'Make Up', 'Penataan Rambut', 'Suasana Salon'];

        // Hanya foto yang berstatus tampil
        $data = Galeri::tampil()
            ->filter($request, ['kategori'])
            ->orderBy('id_galeri')
            ->paginate(9)
            ->withQueryString();

        return view('guest.galeri', compact('data', 'kategori'));
    }
}
