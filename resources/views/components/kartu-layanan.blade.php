{{--
    BLADE COMPONENT: <x-kartu-layanan :layanan="$item" />
    Kartu satu layanan (foto, nama, durasi, harga). Dipakai di Beranda dan halaman Layanan.
--}}
@props(['layanan'])

<div class="kartu-layanan h-100">
    <img src="{{ $layanan->foto_url }}" alt="{{ $layanan->nama_layanan }}" class="kartu-foto">
    <div class="kartu-isi">
        <span class="kartu-kategori">{{ $layanan->kategori }}</span>
        <h3 class="kartu-judul">{{ $layanan->nama_layanan }}</h3>
        <p class="kartu-meta">{{ $layanan->durasi }} menit &middot; Perawatan profesional</p>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="kartu-harga">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
            {{-- Reservasi butuh login --}}
            <a href="{{ route('login') }}" class="btn btn-outline-noona btn-sm px-3">Reservasi</a>
        </div>
    </div>
</div>
