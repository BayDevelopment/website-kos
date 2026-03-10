<header class="mhs-topbar">
    <div class="topbar-left">
        <button class="sidebar-desktop-toggle" id="sidebarDesktopToggle" type="button" aria-label="Minimize sidebar">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>

        <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Buka sidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <div class="topbar-center">
        <form class="topbar-search" action="#" method="GET">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari kos, lokasi, atau kampus...">
        </form>
    </div>

    <div class="topbar-right">
        <a href="#" class="topbar-icon" title="Notifikasi">
            <i class="fa-regular fa-bell"></i>
        </a>

        @php
            $identitas = auth()->user()->identitasMahasiswa;
        @endphp

        <div class="topbar-user">
            <img src="{{ $identitas?->avatar_url ?? asset('image/avatar/profile.png') }}" alt="User Avatar">

            <div class="user-info">
                <strong>{{ $identitas?->nama_lengkap ?? (auth()->user()->name ?? 'Mahasiswa') }}</strong>
                <small style="text-transform: capitalize">{{ auth()->user()->role ?? 'Mahasiswa' }}</small>
            </div>
        </div>
    </div>
</header>
