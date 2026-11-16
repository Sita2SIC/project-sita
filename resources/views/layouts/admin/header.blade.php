{{-- start header --}}
        <header class="header-noona">

            {{-- Sapaan di kiri --}}
            <span class="fw-semibold small">Selamat pagi, {{ strtok(Auth::user()->nama_lengkap, ' ') }}</span>

            <div class="d-flex align-items-center gap-3">

                {{-- Notifikasi --}}
                <div class="dropdown">
                    <a href="#" class="ikon-lonceng" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifikasi">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24"><path d="M6 8a6 6 0 1112 0c0 7 3 8 3 8H3s3-1 3-8z"/><path d="M10 20a2 2 0 004 0"/></svg>
                        <span class="titik"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end mt-2 p-0" style="min-width: 260px;">
                        <div class="p-3 text-center small fw-semibold border-bottom">Notifikasi</div>
                        <div class="p-3 text-center small text-muted">Belum ada notifikasi.</div>
                    </div>
                </div>

                {{-- Avatar inisial + menu --}}
                <div class="dropdown">
                    <a href="#" class="avatar-inisial text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->inisial }}</a>
                    <div class="dropdown-menu dropdown-menu-end mt-2">
                        <span class="dropdown-item-text small fw-semibold">{{ Auth::user()->nama_lengkap }}</span>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        {{-- end header --}}
