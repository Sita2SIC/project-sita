<!--
=========================================================
* Volt Pro - Premium Bootstrap 5 Dashboard
=========================================================
* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themesberg.com/licensing)
* Designed and coded by https://themesberg.com
=========================================================
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Noona Salon by Cortis')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Noona Salon by Cortis">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets-admin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets-admin/img/favicon/favicon-16x16.png') }}">

    <!-- Font Noona -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Start CSS --}}
    @include('layouts.admin.css')
    {{-- Tema warna hijau Noona (harus setelah volt.css) --}}
    <link type="text/css" href="{{ asset('assets-admin/css/noona-admin.css') }}" rel="stylesheet">
    {{-- End CSS --}}

</head>
<body>

    {{-- Start sidebar --}}
    @include('layouts.admin.sidebar')
    {{-- end sidebar --}}

    <main class="content">

        {{-- start header --}}
        @include('layouts.admin.header')
        {{-- end header --}}

        {{-- start main content --}}
        @yield('content')
        {{-- end main content --}}

        {{-- start footer --}}
        @include('layouts.admin.footer')
        {{-- end footer --}}
    </main>

    {{-- start JS --}}
    @include('layouts.admin.js')
    {{-- end JS --}}
</body>
</html>
