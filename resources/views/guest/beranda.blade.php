@extends('layouts.guest.app')

@section('title', 'Noona Salon by Cortis')

@section('content')

{{-- Tombol reservasi: tamu diarahkan daftar, user yang sudah login ke dashboard-nya --}}
@php
    if (Auth::check()) {
        $linkReservasi = Auth::user()->role == 'admin' ? route('admin.dashboard') : route('pelanggan.dashboard');
    } else {
        $linkReservasi = route('register');
    }
@endphp

{{-- HERO --}}
<section class="hero">
    <div class="container">

        {{-- Notifikasi (misal setelah logout) --}}
        @if (session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif

        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <p class="eyebrow">Noona Salon by Cortis &middot; Jakarta</p>
                <h1>Saatnya merawat diri, sepenuh hati.</h1>
                <p class="lead-noona">Temukan jeda yang Anda butuhkan. Perawatan kecantikan personal dalam suasana hangat, tenang, dan penuh perhatian.</p>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ $linkReservasi }}" class="btn btn-noona px-4">Reservasi Sekarang</a>
                    <a href="{{ route('layanan') }}" class="btn btn-outline-noona px-4">Jelajahi Layanan</a>
                </div>

                {{-- Rating hanya muncul kalau sudah ada ulasan --}}
                @if ($jumlahUlasan > 0)
                    <p class="hero-rating mb-0">
                        <x-bintang :rating="round($rataRating)" />
                        {{ number_format($rataRating, 1, ',', '.') }} / 5 &middot; {{ $jumlahUlasan }} ulasan pelanggan
                    </p>
                @endif
            </div>

            <div class="col-lg-6">
                <div class="hero-foto-wrap">
                    <img src="{{ asset('images/hero-beranda.jpg') }}" alt="Perawatan wajah di Noona Salon" class="hero-foto">
                    <div class="hero-caption">
                        <strong>Ritual kecil, rasa istimewa.</strong>
                        Dirancang untuk kecantikan alami Anda.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- LAYANAN UNGGULAN --}}
<section class="bagian" id="layanan-unggulan">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="bagian-judul">Layanan unggulan</h2>
                <p class="bagian-sub mb-0">Perawatan pilihan untuk versi terbaik diri Anda.</p>
            </div>
            <a href="{{ route('layanan') }}" class="btn btn-outline-noona btn-sm px-3">Semua Layanan</a>
        </div>

        <div class="row g-3">
            @forelse ($layanan as $item)
                <div class="col-sm-6 col-lg-3">
                    <x-kartu-layanan :layanan="$item" />
                </div>
            @empty
                <p class="text-center text-muted">Belum ada layanan yang tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- KEUNGGULAN --}}
<section class="bagian">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <img src="{{ asset('images/ruang-salon.jpg') }}" alt="Ruang salon Noona" class="foto-ruang">
            </div>
            <div class="col-lg-6 offset-lg-1">
                <p class="eyebrow">Mengapa Noona</p>
                <h2 class="bagian-judul mb-4">Lebih dari perawat.<br>Sebuah pengalaman.</h2>

                <div class="fitur-item">
                    <div class="fitur-ikon">&#10003;</div>
                    <div><strong>Perawat profesional</strong><span>Terlatih dan berpengalaman, siap merawat Anda dengan sepenuh hati.</span></div>
                </div>
                <div class="fitur-item">
                    <div class="fitur-ikon">&#10003;</div>
                    <div><strong>Produk pilihan terbaik</strong><span>Kami memakai produk berkualitas yang aman dan lembut di kulit.</span></div>
                </div>
                <div class="fitur-item">
                    <div class="fitur-ikon">&#10003;</div>
                    <div><strong>Reservasi tanpa antre</strong><span>Pilih jadwal sesuai waktu Anda, tanpa harus menunggu lama.</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MOMEN DI NOONA --}}
<section class="bagian">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="bagian-judul mb-0">Momen di Noona</h2>
            <a href="{{ route('galeri') }}" class="btn btn-outline-noona btn-sm px-3">Lihat Galeri</a>
        </div>

        <div class="row g-3">
            @forelse ($galeri as $foto)
                <div class="col-md-4">
                    <img src="{{ $foto->foto_url }}" alt="{{ $foto->judul }}" class="galeri-mini">
                </div>
            @empty
                <p class="text-center text-muted">Belum ada foto di galeri.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ULASAN PELANGGAN --}}
<section class="bagian">
    <div class="container">
        <p class="eyebrow">Cerita pelanggan</p>
        <h2 class="bagian-judul mb-4">Pulang dengan senyuman.</h2>

        <div class="row g-3">
            @forelse ($ulasan as $item)
                <div class="col-md-4">
                    <div class="testimoni">
                        <x-bintang :rating="$item->rating" />
                        <p>{{ $item->komentar }}</p>
                        <div class="testimoni-nama">
                            <span class="avatar-inisial">{{ $item->user->inisial }}</span>
                            <div>
                                <strong>{{ $item->user->nama_lengkap }}</strong>
                                <small>{{ $item->reservasi->layanan->nama_layanan }} &middot; {{ $item->tanggal_ulasan->translatedFormat('d F Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada ulasan.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- BANNER AJAKAN --}}
<section class="banner-cta mt-4">
    <div class="container">
        <h2>Waktu untuk diri sendiri dimulai di sini.</h2>
        <p class="mb-4">Pilih perawatan favorit Anda lalu amankan jadwal dalam hitungan menit.</p>
        <a href="{{ $linkReservasi }}" class="btn btn-noona px-4">Reservasi Sekarang</a>
    </div>
</section>
@endsection
