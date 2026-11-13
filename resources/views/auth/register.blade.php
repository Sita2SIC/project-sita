@extends('layouts.auth.app')

@section('title', 'Daftar | Noona Salon by Cortis')

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- Kolom kiri: form registrasi --}}
        <div class="col-lg-6 auth-kiri">

            <a href="{{ route('beranda') }}">@include('layouts.partials.logo')</a>

            <div class="auth-form">
                <h1>Bergabung dengan Noona Salon.</h1>
                <p class="sub">Buat akun untuk menjadwalkan perawatan Anda.</p>

                <form action="{{ route('register.proses') }}" method="POST">
                    @csrf

                    {{-- Nama lengkap --}}
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                               placeholder="Nama lengkap Anda"
                               class="form-control @error('nama_lengkap') is-invalid @enderror" required autofocus>
                        @error('nama_lengkap')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-ikon">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            <span class="ikon">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                            </span>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- No. HP --}}
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. Hp</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                               placeholder="08xxxxxxxxxx"
                               class="form-control @error('no_hp') is-invalid @enderror" required>
                        @error('no_hp')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-ikon">
                            <input type="password" id="password" name="password"
                                   placeholder="Buat password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            <button type="button" class="ikon" onclick="lihatPassword('password')" aria-label="Lihat password">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="form-text">Minimal 8 karakter, gunakan kombinasi huruf dan angka.</div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi password (nama field harus password_confirmation) --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-ikon">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   placeholder="Ulangi password" class="form-control" required>
                            <button type="button" class="ikon" onclick="lihatPassword('password_confirmation')" aria-label="Lihat password">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Persetujuan syarat & ketentuan --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input @error('setuju') is-invalid @enderror" type="checkbox" name="setuju" id="setuju" required>
                        <label class="form-check-label small" for="setuju">
                            Saya menyetujui Syarat &amp; Ketentuan serta Kebijakan Privasi Noona.
                        </label>
                        @error('setuju')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-noona w-100 py-2">Daftar akun</button>
                </form>

                <p class="small mt-4 mb-0">
                    Sudah memiliki akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk</a>
                </p>
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
