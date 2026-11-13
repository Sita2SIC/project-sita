@extends('layouts.auth.app')

@section('title', 'Reset Password | Noona Salon by Cortis')

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- Kolom kiri: form password baru --}}
        <div class="col-lg-6 auth-kiri">

            <a href="{{ route('beranda') }}">@include('layouts.partials.logo')</a>

            <div class="auth-form">
                <h1>Buat password baru.</h1>
                <p class="sub">Gunakan password yang kuat dan mudah Anda ingat.</p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf

                    {{-- Token dari link email (jangan diubah) --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $email) }}"
                               class="form-control @error('email') is-invalid @enderror" required readonly>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password baru --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password baru</label>
                        <div class="input-ikon">
                            <input type="password" id="password" name="password"
                                   placeholder="Buat password baru"
                                   class="form-control @error('password') is-invalid @enderror" required autofocus>
                            <button type="button" class="ikon" onclick="lihatPassword('password')" aria-label="Lihat password">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="form-text">Minimal 8 karakter.</div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
                        <div class="input-ikon">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password baru" class="form-control" required>
                            <button type="button" class="ikon" onclick="lihatPassword('password_confirmation')" aria-label="Lihat password">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-noona w-100 py-2">Simpan password baru</button>
                </form>
            </div>

            <div class="auth-footer">&copy; {{ date('Y') }} Noona Salon by Cortis &middot; Privasi terjaga, waktu Anda berharga.</div>
        </div>

        {{-- Kolom kanan: panel hijau dengan foto --}}
        @include('layouts.partials.panel-auth')
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ubah tipe input password <-> text
    function lihatPassword(id) {
        var input = document.getElementById(id);
        input.type = (input.type === 'password') ? 'text' : 'password';
    }
</script>
@endpush
