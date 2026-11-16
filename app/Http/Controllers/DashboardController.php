<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\User;

class DashboardController extends Controller
{
    // Dashboard admin: kartu statistik, grafik 7 hari, dan jadwal hari ini
    public function admin()
    {
        $hariIni = now()->toDateString();
        $kemarin = now()->subDay()->toDateString();

        // ----- reservasi hari ini -----
        $reservasiHariIni = Reservasi::whereDate('tanggal_reservasi', $hariIni)->count();

        // Reservasi hari ini yang jamnya belum lewat dan belum selesai/batal
        $reservasiBerikutnya = Reservasi::whereDate('tanggal_reservasi', $hariIni)
            ->whereIn('status_reservasi', ['menunggu', 'dikonfirmasi'])
            ->where('jam_reservasi', '>', now()->format('H:i:s'))
            ->count();

        // ----- pendapatan hari ini dibanding kemarin -----
        // sum('diterima') memakai accessor getDiterimaAttribute() di model Pembayaran
        $pendapatanHariIni = Pembayaran::whereDate('tanggal_pembayaran', $hariIni)->get()->sum('diterima');
        $pendapatanKemarin = Pembayaran::whereDate('tanggal_pembayaran', $kemarin)->get()->sum('diterima');

        $persenKemarin = null;
        if ($pendapatanKemarin > 0) {
            $persenKemarin = round(($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin * 100);
        }

        // ----- menunggu pembayaran -----
        $menungguPembayaran = Pembayaran::whereIn('status_pembayaran', ['belum_bayar', 'menunggu_konfirmasi'])->count();

        // ----- total pelanggan -----
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $pelangganBulanIni = User::where('role', 'pelanggan')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // ----- Grafik pendapatan 7 hari terakhir -----
        $grafik = [];
        $nilai = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);
            $total = Pembayaran::whereDate('tanggal_pembayaran', $tanggal->toDateString())->get()->sum('diterima');

            $nilai[] = $total;
            $grafik[] = [
                'label'     => $tanggal->locale('id')->isoFormat('ddd'),
                'nilai'     => $total,
                'tertinggi' => false,
                'tinggi'    => 0,
            ];
        }

        // Skala grafik dibulatkan ke atas per Rp500.000. Tinggi batang maksimal 180px.
        $maks = max($nilai);
        $skala = max(500000, (int) (ceil($maks / 500000) * 500000));

        foreach ($grafik as $k => $g) {
            $grafik[$k]['tinggi'] = max(4, round($g['nilai'] / $skala * 180));
            $grafik[$k]['tertinggi'] = ($maks > 0 && $g['nilai'] == $maks);
        }

        $totalMinggu = array_sum($nilai);
        $rentang = now()->subDays(6)->locale('id')->isoFormat('D MMMM') . ' - ' . now()->locale('id')->isoFormat('D MMMM YYYY');

        // ----- Jadwal hari ini (4 teratas, urut dari jam paling awal) -----
        $jadwal = Reservasi::with(['user', 'layanan'])
            ->whereDate('tanggal_reservasi', $hariIni)
            ->orderBy('jam_reservasi')
            ->take(4)
            ->get();

        $tanggalHariIni = now()->locale('id')->isoFormat('dddd, D MMMM YYYY');

        return view('admin.dashboard', compact(
            'reservasiHariIni', 'reservasiBerikutnya', 'pendapatanHariIni', 'persenKemarin',
            'menungguPembayaran', 'totalPelanggan', 'pelangganBulanIni',
            'grafik', 'skala', 'totalMinggu', 'rentang', 'jadwal', 'tanggalHariIni'
        ));
    }

    // Dashboard pelanggan 
    public function pelanggan()
    {
        return view('pelanggan.dashboard');
    }
}
