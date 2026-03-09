@extends('layouts.mahasiswa')

@section('content_mahasiswa')
    <div class="mhs-dashboard dashboard-modern">
        <section class="welcome-card">
            <div class="welcome-text">
                <span class="welcome-badge">Dashboard Mahasiswa</span>
                <h1>Halo, {{ auth()->user()->name ?? 'Mahasiswa' }} 👋</h1>
                <p>
                    Temukan kos yang nyaman, pantau favoritmu, dan lihat aktivitas pentingmu
                    dalam satu halaman.
                </p>
            </div>

            <div class="welcome-action">
                <a href="#" class="btn-primary-dashboard">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Cari Kos
                </a>
            </div>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon soft-blue">
                    <i class="fa-regular fa-bookmark"></i>
                </div>
                <div>
                    <h3>12</h3>
                    <p>Tersimpan</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon soft-green">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <div>
                    <h3>3</h3>
                    <p>Booking Aktif</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon soft-orange">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <div>
                    <h3>5</h3>
                    <p>Pesan Baru</p>
                </div>
            </div>
        </section>

        <section class="content-grid">
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h2>Rekomendasi Kos</h2>
                        <p>Pilihan kos yang mungkin cocok untukmu</p>
                    </div>
                    <a href="#">Lihat semua</a>
                </div>

                <div class="modern-kos-list">
                    <div class="modern-kos-item">
                        <img src="#" alt="Kos Mawar">
                        <div class="modern-kos-info">
                            <h4>Kos Mawar Dekat Kampus</h4>
                            <p><i class="fa-solid fa-location-dot"></i> Cilegon, dekat kampus</p>
                            <div class="modern-kos-meta">
                                <span class="price">Rp850.000 / bulan</span>
                                <span class="tag">Putri</span>
                            </div>
                        </div>
                    </div>

                    <div class="modern-kos-item">
                        <img src="#" alt="Kos Melati">
                        <div class="modern-kos-info">
                            <h4>Kos Melati Residence</h4>
                            <p><i class="fa-solid fa-location-dot"></i> Serang, akses mudah</p>
                            <div class="modern-kos-meta">
                                <span class="price">Rp700.000 / bulan</span>
                                <span class="tag">Campur</span>
                            </div>
                        </div>
                    </div>

                    <div class="modern-kos-item">
                        <img src="#" alt="Kos Anggrek">
                        <div class="modern-kos-info">
                            <h4>Kos Anggrek Exclusive</h4>
                            <p><i class="fa-solid fa-location-dot"></i> Serang Kota</p>
                            <div class="modern-kos-meta">
                                <span class="price">Rp1.200.000 / bulan</span>
                                <span class="tag">AC + WiFi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-card compact-card">
                <div class="card-head">
                    <div>
                        <h2>Aktivitas</h2>
                        <p>Update terbaru akunmu</p>
                    </div>
                </div>

                <ul class="modern-activity-list">
                    <li>
                        <span class="activity-dot blue-dot"></span>
                        <div>
                            <strong>Favorit ditambahkan</strong>
                            <p>Kos Mawar Dekat Kampus masuk daftar favorit.</p>
                        </div>
                    </li>
                    <li>
                        <span class="activity-dot green-dot"></span>
                        <div>
                            <strong>Booking aktif</strong>
                            <p>Kamu melakukan booking untuk Kos Melati Residence.</p>
                        </div>
                    </li>
                    <li>
                        <span class="activity-dot orange-dot"></span>
                        <div>
                            <strong>Pesan baru</strong>
                            <p>Ada pesan masuk dari pemilik kos.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
@endsection
