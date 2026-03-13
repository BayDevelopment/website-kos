<aside class="mhs-sidebar" id="mhsSidebar">
    <div class="sidebar-top">
        <div class="sidebar-brand">
            <a href="{{ route('pemilik.dashboard') }}">
                <img src="{{ asset('image/logo-nav.png') }}" alt="Logo RoomKos" class="sidebar-logo">
            </a>
        </div>

        <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Tutup sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    @php
        $user = auth()->user();
        $pemilik = $user->identitasPemilik ?? null;
        $profilComplete = (bool) ($pemilik?->is_complete ?? false);
        $approved = strtolower(trim($pemilik?->verification_status ?? '')) === 'approved';
    @endphp

    <nav class="sidebar-menu">

        @if (!$profilComplete || !$approved)

            {{-- Skeleton Loader --}}
            @for ($i = 0; $i < 6; $i++)
                <div class="sidebar-skeleton">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-text"></div>
                </div>
            @endfor
        @else
            <a href="{{ route('pemilik.dashboard') }}" class="{{ $navlink === 'Dashboard' ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="{{ route('pemilik.kos.index') }}" class="{{ $navlink === 'Kelola Kos' ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i>
                <span class="menu-text">Kelola Kos</span>
            </a>

            <a href="#" class="{{ $navlink === 'Kamar' ? 'active' : '' }}">
                <i class="fa-solid fa-bed"></i>
                <span class="menu-text">Kamar</span>
            </a>

            <a href="{{ route('pemilik.booking.index') }}" class="{{ $navlink === 'Booking' ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i>
                <span class="menu-text">Booking</span>
            </a>

            <a href="#" class="{{ $navlink === 'Penyewa' ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i>
                <span class="menu-text">Penyewa</span>
            </a>

            <a href="#" class="{{ $navlink === 'Pembayaran' ? 'active' : '' }}">
                <i class="fa-solid fa-wallet"></i>
                <span class="menu-text">Pembayaran</span>
            </a>

            <a href="#" class="{{ $navlink === 'Ulasan' ? 'active' : '' }}">
                <i class="fa-solid fa-star"></i>
                <span class="menu-text">Ulasan</span>
            </a>

            <a href="#" class="{{ $navlink === 'Pesan' ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i>
                <span class="menu-text">Pesan</span>
            </a>

            <a href="#" class="{{ $navlink === 'Profil' ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span class="menu-text">Profil</span>
            </a>

        @endif

        <form action="{{ route('logout') }}" method="POST" class="sidebar-logout-form">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="menu-text">Logout</span>
            </button>
        </form>
    </nav>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
