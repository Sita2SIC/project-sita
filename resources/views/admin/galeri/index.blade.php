@extends('layouts.admin.app')

@section('title', 'Kelola Galeri | Noona Salon')

@section('content')
<div class="py-4">

    {{-- Header Page --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
            <h1 class="judul-halaman">Kelola Galeri</h1>
            <p class="mb-0 text-muted">Kurasi momen dan hasil perawatan yang muncul di situs Noona.</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Unggah Foto</a>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    {{-- Pencarian (method GET) --}}
    <form method="GET" action="{{ route('admin.galeri.index') }}" class="mb-3">
        @if (request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul atau kategori foto...">
    </form>

    {{-- Filter kategori --}}
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.galeri.index', ['search' => request('search')]) }}" class="chip {{ request('kategori') ? '' : 'aktif' }}">Semua</a>
        @foreach ($kategori as $k)
            <a href="{{ route('admin.galeri.index', ['kategori' => $k, 'search' => request('search')]) }}"
               class="chip {{ request('kategori') == $k ? 'aktif' : '' }}">{{ $k }}</a>
        @endforeach
    </div>

    {{-- GRID FOTO--}}
    <div class="row g-3">
        @forelse ($data as $item)
            <div class="col-md-4">
                <div class="kartu-galeri">
                    <img src="{{ $item->foto_url }}" alt="{{ $item->judul }}">
                    <div class="isi">
                        <div class="judul">{{ $item->judul }}</div>
                        <div class="meta">
                            {{ $item->kategori }} &middot; Ditambahkan {{ $item->created_at->translatedFormat('d F Y') }}
                            <x-status-badge :status="$item->status" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link btn-sm text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted py-5">Belum ada foto di galeri.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
