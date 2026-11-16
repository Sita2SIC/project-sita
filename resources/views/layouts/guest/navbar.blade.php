{{-- start navbar --}}
<nav class="navbar navbar-expand-lg navbar-noona">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">@include('layouts.partials.logo')</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">
            {{-- Menu halaman --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Ulasan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang</a></li>
            </ul>

            {{-- Tombol kanan: berbeda untuk tamu dan user yang sudah login --}}
            <div class="d-flex align-items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="nav-link fw-semibold">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-noona btn-sm px-3">Daftar</a>
                @endguest

                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-noona btn-sm px-3">Dashboard</a>
                    @else
                        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-outline-noona btn-sm px-3">Dashboard</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
{{-- end navbar --}}
