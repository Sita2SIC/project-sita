{{--
    BLADE COMPONENT: <x-status-badge status="dikonfirmasi" />
    Label berwarna untuk status reservasi, pembayaran, layanan, galeri, dan ulasan.
--}}
@props(['status'])

@php
    // Warna badge berdasarkan nilai status di database
    $kelas = [
        'menunggu' => 'badge-menunggu',
        'dikonfirmasi' => 'badge-konfirmasi',
        'selesai' => 'badge-selesai',
        'dibatalkan' => 'badge-batal',
        'belum_bayar' => 'badge-menunggu',
        'menunggu_konfirmasi' => 'badge-menunggu',
        'dp' => 'badge-konfirmasi',
        'lunas' => 'badge-selesai',
        'aktif' => 'badge-selesai',
        'nonaktif' => 'badge-batal',
        'tampil' => 'badge-selesai',
        'disembunyikan' => 'badge-batal',
    ];

    // Teks yang ditampilkan (kalau tidak ada di sini, pakai nilai aslinya dengan huruf kapital di awal)
    $teks = [
        'belum_bayar' => 'Belum Bayar',
        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
        'dp' => 'DP',
        'lunas' => 'Lunas',
    ];
@endphp

<span class="badge-status {{ $kelas[$status] ?? 'badge-menunggu' }}">{{ $teks[$status] ?? ucfirst($status) }}</span>
