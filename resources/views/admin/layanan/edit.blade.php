@extends('layouts.admin.app')

@section('title', 'Edit Layanan | Noona Salon')

@section('content')
<div class="py-4">

    <div class="mb-4">
        <h1 class="judul-halaman">Edit layanan.</h1>
        <p class="mb-0 text-muted">Ubah data {{ $layanan->nama_layanan }}, lalu simpan perubahan.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- HTML form hanya mengenal GET/POST, jadi PUT dikirim lewat @method --}}
                @method('PUT')

                @include('admin.layanan._form')

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
