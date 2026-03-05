<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Mahasiswa — RoomKos')</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>

<body>

    <div class="app">
        @include('partials.mahasiswa.sidebar')

        <div class="app-main">
            @include('partials.mahasiswa.topbar')

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>

</html>
