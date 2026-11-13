<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Noona Salon by Cortis')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Noona --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- CSS Noona --}}
    <link href="{{ asset('assets-guest/css/noona.css') }}" rel="stylesheet">
</head>
<body>

    {{-- start navbar --}}
    @include('layouts.guest.navbar')
    {{-- end navbar --}}

    {{-- start main content --}}
    @yield('content')
    {{-- end main content --}}

    {{-- start footer --}}
    @include('layouts.guest.footer')
    {{-- end footer --}}

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
