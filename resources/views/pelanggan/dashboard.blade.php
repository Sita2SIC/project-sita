@extends('layouts.pelanggan.app')

@section('title', 'Dashboard Pelanggan | Noona Salon')

@section('content')
<div class="container py-5">

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Banner sambutan (isi lengkap dibuat di Tahap 6) --}}
    <div class="p-4 rounded-4" style="background-color: var(--mint);">
        <h1 class="h2">Selamat datang, {{ Auth::user()->nama_lengkap }}.</h1>
        <p class="mb-0">Hari yang baik dimulai dengan merawat diri. Dashboard lengkap dibuat di Tahap 6.</p>
    </div>
</div>
@endsection
