@extends('layouts.admin.app')

@section('title', 'Tambah Layanan | Noona Salon')

@section('content')
<div class="py-4">

    <div class="mb-4">
        <h1 class="judul-halaman">Tambahkan layanan baru.</h1>
        <p class="mb-0 text-muted">Isi data perawatan, lalu simpan. Layanan aktif langsung tampil di halaman pelanggan.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            {{-- enctype multipart wajib untuk upload file --}}
            <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.layanan._form')

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Layanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
