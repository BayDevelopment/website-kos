<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RoomKos — Kos Cilegon & Serang')</title>

    {{-- CSS tanpa Vite --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
