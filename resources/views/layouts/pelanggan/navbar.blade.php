{{-- start navbar pelanggan --}}
<nav class="navbar navbar-expand-lg navbar-noona">
    <div class="container">
        <a class="navbar-brand" href="{{ route('pelanggan.dashboard') }}">@include('layouts.partials.logo')</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar" aria-controls="menuNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavbar">
            {{-- Menu pelanggan (link Layanan, Reservasi, Ulasan dibuat di Tahap 6-7) --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}" href="{{ route('pelanggan.dashboard') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reservasi</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Ulasan</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                {{-- Notifikasi (diisi data di Tahap 9) --}}
                <a href="#" class="ikon-lonceng" aria-label="Notifikasi">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M6 8a6 6 0 1112 0c0 7 3 8 3 8H3s3-1 3-8z"/><path d="M10 20a2 2 0 004 0"/></svg>
                    <span class="titik"></span>
                </a>

                {{-- Avatar + menu profil --}}
                <div class="dropdown">
                    <a href="#" class="avatar-inisial text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->inisial }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text small fw-semibold">{{ Auth::user()->nama_lengkap }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
{{-- end navbar pelanggan --}}
