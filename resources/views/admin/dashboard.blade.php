@extends('layouts.admin.app')

@section('title', 'Dashboard Admin | Noona Salon')

@section('content')
<div class="py-4">

    {{-- Header Page --}}
    <div class="mb-4">
        <h1 class="judul-halaman">Hari yang indah untuk melayani.</h1>
        <p class="mb-0 text-muted small">Pantau reservasi dan sambut setiap pelanggan dengan tenang.</p>
    </div>

    {{-- Notifikasi berhasil (misal setelah login) --}}
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    {{-- Ikon kalender kecil untuk kartu statistik --}}
    @php
        $ikon = '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>';
    @endphp

    {{-- KARTU STATISTIK --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="kartu-stat">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="kartu-label">Reservasi Hari Ini</span>
                    {!! $ikon !!}
                </div>
                <div class="angka">{{ $reservasiHariIni }}</div>
                <div class="ket">{{ $reservasiBerikutnya }} reservasi berikutnya</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="kartu-stat">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="kartu-label">Pendapatan Hari Ini</span>
                    {!! $ikon !!}
                </div>
                <div class="angka">Rp{{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                <div class="ket">
                    @if ($persenKemarin !== null)
                        {{ $persenKemarin >= 0 ? '↑' : '↓' }} {{ abs($persenKemarin) }}% dari kemarin
                    @else
                        Belum ada pendapatan kemarin
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="kartu-stat">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="kartu-label">Menunggu Pembayaran</span>
                    {!! $ikon !!}
                </div>
                <div class="angka">{{ $menungguPembayaran }}</div>
                <div class="ket">Perlu dicek oleh kasir</div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="kartu-stat">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="kartu-label">Total Pelanggan</span>
                    {!! $ikon !!}
                </div>
                <div class="angka">{{ $totalPelanggan }}</div>
                <div class="ket">+{{ $pelangganBulanIni }} pelanggan bulan ini</div>
            </div>
        </div>
    </div>

    <div class="row g-3">

        {{-- GRAFIK PENDAPATAN 7 HARI --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h2 class="judul-kartu">Pendapatan 7 hari terakhir</h2>
                    <p class="text-muted small mb-3">Pendapatan (rupiah) &middot; Skala 0&ndash;Rp{{ number_format($skala, 0, ',', '.') }}</p>

                    <div class="grafik">
                        @foreach ($grafik as $g)
                            <div class="grafik-kolom">
                                <div class="grafik-batang {{ $g['tertinggi'] ? 'aktif' : '' }}"
                                     style="height: {{ $g['tinggi'] }}px"
                                     title="Rp{{ number_format($g['nilai'], 0, ',', '.') }}"></div>
                                <span class="grafik-label">{{ $g['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="text-muted small mt-3 mb-0">{{ $rentang }} &middot; Total Rp{{ number_format($totalMinggu, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- JADWAL HARI INI --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h2 class="judul-kartu">Jadwal Hari Ini</h2>
                        <a href="#" class="small fw-semibold">Semua reservasi</a>
                    </div>
                    <p class="text-muted small mb-2">{{ $tanggalHariIni }} &middot; {{ $jadwal->count() }} dari {{ $reservasiHariIni }} reservasi</p>

                    @forelse ($jadwal as $item)
                        <div class="jadwal-item">
                            <span class="jadwal-jam">{{ substr($item->jam_reservasi, 0, 5) }}</span>
                            <span class="jadwal-nama">
                                {{ $item->user->nama_lengkap }}<br>
                                <small>{{ $item->layanan->nama_layanan }}</small>
                            </span>
                            <x-status-badge :status="$item->status_reservasi" />
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Belum ada jadwal hari ini.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
