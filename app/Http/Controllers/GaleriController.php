<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Daftar kategori galeri (4 layanan + suasana salon)
    private $daftarKategori = ['Manicure & Pedicure', 'Facial Glow', 'Make Up', 'Penataan Rambut', 'Suasana Salon'];

    // Menampilkan galeri dalam bentuk grid (dengan pencarian, filter kategori, dan pagination)
    public function index(Request $request)
    {
        $data = Galeri::filter($request, ['kategori'])
            ->search($request, ['judul', 'kategori'])
            ->orderBy('id_galeri', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('admin.galeri.index', [
            'data'     => $data,
            'kategori' => $this->daftarKategori,
        ]);
    }

    // Menampilkan form unggah foto
    public function create()
    {
        return view('admin.galeri.create', ['kategori' => $this->daftarKategori]);
    }

    // Menyimpan BANYAK foto sekaligus (multiple upload)
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:100',
            'kategori' => 'required|in:' . implode(',', $this->daftarKategori),
            'status'   => 'required|in:tampil,disembunyikan',
            'foto'     => 'required|array|min:1|max:10',       // maksimal 10 foto sekali unggah
            'foto.*'   => 'image|mimes:jpg,jpeg,png|max:2048', // setiap foto maksimal 2 MB
        ], $this->pesan());

        // $request->file('foto') berisi array file. Setiap file disimpan sebagai satu baris galeri.
        foreach ($request->file('foto') as $file) {
            Galeri::create([
                'judul'    => $request->judul,
                'kategori' => $request->kategori,
                'status'   => $request->status,
                'foto'     => $file->store('galeri', 'public'),
            ]);
        }

        $jumlah = count($request->file('foto'));

        return redirect()->route('admin.galeri.index')->with('success', $jumlah . ' foto berhasil diunggah.');
    }

    // Menampilkan form edit satu foto
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', [
            'galeri'   => $galeri,
            'kategori' => $this->daftarKategori,
        ]);
    }

    // Menyimpan perubahan satu foto (foto boleh diganti)
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'    => 'required|string|max:100',
            'kategori' => 'required|in:' . implode(',', $this->daftarKategori),
            'status'   => 'required|in:tampil,disembunyikan',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], $this->pesan());

        $data['judul']    = $request->judul;
        $data['kategori'] = $request->kategori;
        $data['status']   = $request->status;

        if ($request->hasFile('foto')) {
            $this->hapusFile($galeri);
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diperbarui.');
    }

    // Menghapus satu foto
    public function destroy(Galeri $galeri)
    {
        $this->hapusFile($galeri);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil dihapus.');
    }

    // Menghapus file foto dari storage. Foto data contoh (di public/images) tidak ikut dihapus.
    private function hapusFile(Galeri $galeri)
    {
        if (! str_starts_with($galeri->foto, 'images/')) {
            Storage::disk('public')->delete($galeri->foto);
        }
    }

    // Pesan error bahasa Indonesia
    private function pesan()
    {
        return [
            'judul.required'    => 'Judul foto wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in'       => 'Kategori tidak valid.',
            'foto.required'     => 'Pilih minimal satu foto.',
            'foto.max'          => 'Foto maksimal 10 file sekali unggah.',
            'foto.*.image'      => 'Semua file harus berupa gambar.',
            'foto.*.mimes'      => 'Foto harus berformat JPG atau PNG.',
            'foto.*.max'        => 'Ukuran setiap foto maksimal 2 MB.',
            'foto.image'        => 'File harus berupa gambar.',
            'foto.mimes'        => 'Foto harus berformat JPG atau PNG.',
        ];
    }
}
