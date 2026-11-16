@extends('layouts.guest.app')

@section('title', 'Layanan | Noona Salon by Cortis')

@section('content')
<section class="hero pb-5">
    <div class="container">
        <p class="eyebrow">Menu perawatan</p>
        <h1 class="bagian-judul" style="font-size: 2.6rem;">Temukan ritual favorit Anda.</h1>
        <p class="bagian-sub mb-4">Dari sentuhan kecil hingga transformasi istimewa. Semua dimulai dengan satu langkah.</p>

        {{-- Pencarian (method GET) --}}
        <form method="GET" action="{{ route('layanan') }}" class="mb-3">
            @if (request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <div class="cari-wrap">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari layanan atau kata kunci...">
            </div>
        </form>

        {{-- Filter kategori (berupa link supaya mudah dibagikan) --}}
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('layanan', ['search' => request('search')]) }}" class="chip {{ request('kategori') ? '' : 'aktif' }}">Semua</a>
            @foreach ($kategori as $k)
                <a href="{{ route('layanan', ['kategori' => $k, 'search' => request('search')]) }}"
                   class="chip {{ request('kategori') == $k ? 'aktif' : '' }}">{{ $k }}</a>
            @endforeach
        </div>

        {{-- Daftar layanan --}}
        <div class="row g-3">
            @forelse ($data as $item)
                <div class="col-md-6">
                    <x-kartu-layanan :layanan="$item" />
                </div>
            @empty
                <p class="text-center text-muted py-5">Layanan tidak ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
@endsection
