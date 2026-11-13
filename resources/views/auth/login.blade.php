@extends('layouts.auth.app')

@section('title', 'Masuk | Noona Salon by Cortis')

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- Kolom kiri: form login --}}
        <div class="col-lg-6 auth-kiri">

            <a href="{{ route('beranda') }}">@include('layouts.partials.logo')</a>

            <div class="auth-form">
                <h1>Selamat Datang di Noona Salon by Cortis.</h1>
                <p class="sub">Masuk untuk membuat reservasi dan menikmati perawatan favorit anda.</p>

                {{-- Notifikasi berhasil --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Notifikasi error (misal belum login) --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
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

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-ikon">
                            <input type="password" id="password" name="password"
                                   placeholder="Masukkan password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            {{-- Tombol lihat/sembunyikan password --}}
                            <button type="button" class="ikon" onclick="lihatPassword('password')" aria-label="Lihat password">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Ingat saya & lupa password --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Ingat saya</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="small fw-semibold text-decoration-none">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-noona w-100 py-2">Masuk</button>
                </form>

                <p class="small mt-4 mb-0">
                    Belum memiliki akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar sekarang</a>
                </p>

                <div class="auth-garis"></div>

                <div class="auth-catatan">
                    <svg width="18" height="18" fill="none" stroke="#1F3D31" stroke-width="1.6" viewBox="0 0 24 24" class="flex-shrink-0"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6l8-3z"/><path d="M9 12l2 2 4-4"/></svg>
                    <span>Dengan melanjutkan, kamu menyetujui <a href="#">Syarat &amp; Ketentuan</a> ini dan kamu sudah diberitahu mengenai <a href="#">Pemberitahuan Privasi</a> kami.</span>
                </div>
            </div>

            <div class="auth-footer">&copy; {{ date('Y') }} Noona Salon by Cortis &middot; Privasi terjaga, waktu Anda berharga.</div>
        </div>

        {{-- Kolom kanan: panel hijau dengan foto --}}
        <div class="col-lg-6 d-none d-lg-block p-0">
            <div class="auth-kanan">
                <div class="auth-bingkai">
                    <div class="auth-foto"></div>
                    <h2>Cantik yang terasa. Tenang yang tinggal.</h2>
                    <p>Satu ruang untuk merawat diri, satu langkah menuju hari yang lebih baik. Kenyamanan anda sangat berarti bagi kami.</p>
                    <div class="auth-label-bawah">
                        <span>Perawatan personal</span>
                        <span>Reservasi tanpa antre</span>
                    </div>
                </div>
            </div>
        </div>
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
