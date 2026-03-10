<aside class="mhs-sidebar" id="mhsSidebar">
    <div class="sidebar-top">
        <div class="sidebar-brand">
            <a href="{{ route('mahasiswa.dashboard') }}">
                <img src="{{ asset('image/logo-nav.png') }}" alt="Logo RoomKos" class="sidebar-logo">
            </a>
        </div>

        <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Tutup sidebar">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    @php
        $user = auth()->user();
        $identitas = $user->identitasMahasiswa;
        $identitasComplete = $identitas?->is_complete ?? false;
        $approved = $identitas?->verification_status === 'approved';
    @endphp
    <nav class="sidebar-menu">

        @if (!$identitasComplete || !$approved)

            {{-- Skeleton Loader --}}
            @for ($i = 0; $i < 5; $i++)
                <div class="sidebar-skeleton">
                    <div class="skeleton-icon"></div>
                    <div class="skeleton-text"></div>
                </div>
            @endfor
        @else
            <a href="{{ route('mahasiswa.dashboard') }}" class="{{ $navlink === 'Dashboard' ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span class="menu-text">Dashboard</span>
            </a>

            <a href="#" class="{{ $navlink === 'Cari Kos' ? 'active' : '' }}">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="menu-text">Cari Kos</span>
            </a>

            <a href="#" class="{{ $navlink === 'Tersimpan' ? 'active' : '' }}">
                <i class="fa-solid fa-bookmark"></i>
                <span class="menu-text">Tersimpan</span>
            </a>

            <a href="#" class="{{ $navlink === 'Booking' ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i>
                <span class="menu-text">Booking</span>
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

        {{-- Logout selalu tampil --}}
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
