@extends('layouts.pelanggan.app')

@section('title', 'Dashboard Pelanggan | Noona Salon')

@section('content')
<div class="container py-5">

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    {{-- Banner sambutan --}}
    <div class="p-4 rounded-4" style="background-color: var(--mint);">
        <h1 class="h2">Selamat datang, {{ Auth::user()->nama_lengkap }}.</h1>
        <p class="mb-0">Hari yang baik dimulai dengan merawat diri.</p>
    </div>
</div>
@endsection
