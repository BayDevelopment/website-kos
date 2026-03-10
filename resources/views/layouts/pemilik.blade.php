<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Mahasiswa' }}</title>

    <link rel="stylesheet" href="{{ asset('css/pemilik.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @stack('styles')
</head>

<body class="role-pemilik" @if (session('success')) data-toast-success="{{ session('success') }}" @endif>
    @include('partials.pemilik.sidebar')

    <div class="mhs-main" id="mhsMain">
        @include('partials.pemilik.navbar')

        <main class="mhs-content">
            @yield('content_pemilik')
        </main>

        @include('partials.pemilik.footer')
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="{{ asset('js/navbar-toogle.js') }}"></script>
    <script defer src="{{ asset('js/sweetalert.js') }}"></script>
    @stack('script')
</body>

</html>
