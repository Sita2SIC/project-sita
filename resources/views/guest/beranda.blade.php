@extends('layouts.guest.app')

@section('title', 'Noona Salon by Cortis')

@section('content')
<div class="container text-center py-5">

    {{-- Notifikasi berhasil (misal setelah logout) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="display-4 mt-5">Noona Salon by Cortis</h1>
    <p class="lead">Halaman Beranda lengkap dibuat di Tahap 2.</p>
</div>
@endsection
