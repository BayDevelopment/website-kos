<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RoomKos — Kos Cilegon & Serang')</title>

    {{-- CSS tanpa Vite --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>

<body>

    @include('partials.guest.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.guest.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
