@extends('layouts.admin.app')

@section('title', 'Dashboard Admin | Noona Salon')

@section('content')
<div class="py-4">

    {{-- Header Page --}}
    <div class="d-flex justify-content-between align-items-center w-100 flex-wrap mb-4">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Dashboard</h1>
            <p class="mb-0">Ringkasan reservasi dan pendapatan salon.</p>
        </div>
    </div>

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Content Card --}}
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <p class="mb-0">Anda login sebagai admin. Kartu statistik dan grafik dibuat di Tahap 3.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
