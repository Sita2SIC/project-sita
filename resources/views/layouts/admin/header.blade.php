{{-- start header --}}
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">

                    {{-- Sapaan di kiri --}}
                    <div class="d-flex align-items-center">
                        <span class="fw-bold text-gray-900">Selamat pagi, {{ strtok(Auth::user()->nama_lengkap, ' ') }}</span>
                    </div>

                    {{-- Menu di kanan --}}
                    <ul class="navbar-nav align-items-center">

                        {{-- Notifikasi (diisi data di Tahap 9) --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link text-dark notification-bell dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <svg class="icon icon-sm text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                                <div class="list-group list-group-flush">
                                    <span class="text-center text-primary fw-bold border-bottom border-light py-3">Notifikasi</span>
                                    <span class="list-group-item text-center">Belum ada notifikasi.</span>
                                </div>
                            </div>
                        </li>

                        {{-- Profil admin --}}
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <span class="avatar-inisial">{{ Auth::user()->inisial }}</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- end header --}}
