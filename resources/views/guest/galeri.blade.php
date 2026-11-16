@extends('layouts.guest.app')

@section('title', 'Galeri | Noona Salon by Cortis')

@section('content')
<section class="hero pb-5">
    <div class="container">
        <p class="eyebrow">Sebuah ruang untuk Anda</p>
        <h1 class="bagian-judul" style="font-size: 2.6rem;">Keindahan dalam setiap detail.</h1>
        <p class="bagian-sub mb-4">Intip suasana, hasil perawatan, dan momen hangat di Noona.</p>

        {{-- Filter kategori --}}
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('galeri') }}" class="chip {{ request('kategori') ? '' : 'aktif' }}">Semua</a>
            @foreach ($kategori as $k)
                <a href="{{ route('galeri', ['kategori' => $k]) }}" class="chip {{ request('kategori') == $k ? 'aktif' : '' }}">{{ $k }}</a>
            @endforeach
        </div>

        {{-- Grid foto --}}
        <div class="row g-3">
            @forelse ($data as $foto)
                <div class="col-md-4">
                    <img src="{{ $foto->foto_url }}" alt="{{ $foto->judul }}" class="galeri-foto">
                    <div class="galeri-caption">{{ $foto->judul }} &middot; {{ $foto->kategori }}</div>
                </div>
            @empty
                <p class="text-center text-muted py-5">Belum ada foto di galeri.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
