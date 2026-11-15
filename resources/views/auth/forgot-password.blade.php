@extends('layouts.auth.app')

@section('title', 'Lupa Password | Noona Salon by Cortis')

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- Kolom kiri: form lupa password --}}
        <div class="col-lg-6 auth-kiri">

            <a href="{{ route('beranda') }}">@include('layouts.partials.logo')</a>

            <div class="auth-form">
                <h1>Lupa password?</h1>
                <p class="sub">Masukkan email akun Anda. Kami akan mengirim link untuk membuat password baru.</p>

                {{-- Notifikasi link berhasil dikirim --}}
                @if (session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-ikon">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   class="form-control @error('email') is-invalid @enderror" required autofocus>
                            <span class="ikon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                            </span>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-noona w-100 py-2">Kirim link reset</button>
                </form>

                <p class="small mt-4 mb-0">
                    Ingat password Anda? <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke halaman masuk</a>
                </p>
            </div>

            <div class="auth-footer">&copy; {{ date('Y') }} Noona Salon by Cortis &middot; Privasi terjaga, waktu Anda berharga.</div>
        </div>

        {{-- Kolom kanan: panel hijau dengan foto --}}
        @include('layouts.partials.panel-auth')
    </div>
</div>
@endsection
