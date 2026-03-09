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

        <div class="topbar-user">
            <img src="{{ auth()->user()->avatar
                ? asset('storage/' . auth()->user()->avatar)
                : (auth()->user()->jenis_kelamin === 'laki-laki'
                    ? asset('image/avatar/man.png')
                    : (auth()->user()->jenis_kelamin === 'perempuan'
                        ? asset('image/avatar/woman.png')
                        : asset('image/avatar/profile.png'))) }}"
                alt="User Avatar">
            <div class="user-info">
                <strong>{{ auth()->user()->name ?? 'Mahasiswa' }}</strong>
                <small>Mahasiswa</small>
            </div>
        </div>
    </div>
</header>
