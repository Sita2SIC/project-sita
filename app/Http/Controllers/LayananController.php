<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    // Daftar kategori, dipakai untuk filter dan pilihan di form
    private $daftarKategori = ['Manicure & Pedicure', 'Facial Glow', 'Make Up', 'Penataan Rambut'];

    // Menampilkan daftar layanan (dengan pencarian, filter, dan pagination)
    public function index(Request $request)
    {
        $filterableColumns = ['kategori', 'status'];   // kolom yang bisa difilter
        $searchableColumns = ['nama_layanan'];         // kolom yang bisa dicari

        $data = Layanan::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('id_layanan', 'desc')
            ->paginate(10)
            ->withQueryString();   // supaya filter tidak hilang saat pindah halaman

        return view('admin.layanan.index', [
            'data'     => $data,
            'kategori' => $this->daftarKategori,
        ]);
    }

    // Menampilkan form tambah layanan
    public function create()
    {
        return view('admin.layanan.create', ['kategori' => $this->daftarKategori]);
    }

    // Menyimpan layanan baru (termasuk upload foto)
    public function store(Request $request)
    {
        $request->validate($this->aturan(), $this->pesan());

        $data['nama_layanan'] = $request->nama_layanan;
        $data['kategori']     = $request->kategori;
        $data['deskripsi']    = $request->deskripsi;
        $data['harga']        = $request->harga;
        $data['durasi']       = $request->durasi;
        $data['status']       = $request->status;

        // Upload foto: disimpan di storage/app/public/layanan
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Menampilkan form edit layanan
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', [
            'layanan'  => $layanan,
            'kategori' => $this->daftarKategori,
        ]);
    }

    // Menyimpan perubahan layanan (foto lama diganti kalau ada foto baru)
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate($this->aturan(), $this->pesan());

        $data['nama_layanan'] = $request->nama_layanan;
        $data['kategori']     = $request->kategori;
        $data['deskripsi']    = $request->deskripsi;
        $data['harga']        = $request->harga;
        $data['durasi']       = $request->durasi;
        $data['status']       = $request->status;

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage supaya tidak menumpuk
            if ($layanan->foto) {
                Storage::disk('public')->delete($layanan->foto);
            }
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    // Menghapus layanan
    public function destroy(Layanan $layanan)
    {
        // Layanan yang sudah pernah dipesan tidak boleh dihapus (ada relasi ke tabel reservasi)
        if ($layanan->reservasi()->exists()) {
            return back()->with('error', 'Layanan tidak bisa dihapus karena sudah dipakai di reservasi. Ubah statusnya menjadi nonaktif.');
        }

        if ($layanan->foto) {
            Storage::disk('public')->delete($layanan->foto);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    // Aturan validasi (dipakai store dan update)
    private function aturan()
    {
        return [
            'nama_layanan' => 'required|string|max:100',
            'kategori'     => 'required|in:' . implode(',', $this->daftarKategori),
            'deskripsi'    => 'nullable|string',
            'harga'        => 'required|integer|min:0',
            'durasi'       => 'required|integer|min:1|max:600',
            'status'       => 'required|in:aktif,nonaktif',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',   // maksimal 2 MB
        ];
    }

    // Pesan error bahasa Indonesia
    private function pesan()
    {
        return [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'kategori.required'     => 'Kategori wajib dipilih.',
            'kategori.in'           => 'Kategori tidak valid.',
            'harga.required'        => 'Harga wajib diisi.',
            'harga.integer'         => 'Harga harus berupa angka.',
            'durasi.required'       => 'Durasi wajib diisi.',
            'durasi.integer'        => 'Durasi harus berupa angka (menit).',
            'status.required'       => 'Status wajib dipilih.',
            'foto.image'            => 'File harus berupa gambar.',
            'foto.mimes'            => 'Foto harus berformat JPG atau PNG.',
            'foto.max'              => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
