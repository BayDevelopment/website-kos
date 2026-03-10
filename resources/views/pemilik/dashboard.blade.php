@extends('layouts.pemilik')

@section('content_pemilik')
    @php
        $user = auth()->user();
        $pemilik = $user->pemilikKos ?? null;

        $namaPemilik = $pemilik?->nama_lengkap ?? ($user->name ?? 'Pemilik Kos');

        // Dummy data sementara, nanti tinggal ganti dari controller
        $totalKos = $totalKos ?? 3;
        $kamarTersedia = $kamarTersedia ?? 12;
        $bookingMasuk = $bookingMasuk ?? 8;
        $pendapatanBulanIni = $pendapatanBulanIni ?? 'Rp 7.500.000';

        $daftarKos =
            $daftarKos ??
            collect([
                (object) [
                    'nama' => 'Kos Melati Residence',
                    'lokasi' => 'Dekat Kampus, Bandung',
                    'harga' => 'Rp 850.000 / bulan',
                    'status' => 'Aktif',
                    'kamar' => '4 kamar kosong',
                    'gambar' => asset('image/default-kos.jpg'),
                ],
                (object) [
                    'nama' => 'Kos Putra Harmoni',
                    'lokasi' => 'Cicaheum, Bandung',
                    'harga' => 'Rp 950.000 / bulan',
                    'status' => 'Penuh',
                    'kamar' => '0 kamar kosong',
                    'gambar' => asset('image/default-kos.jpg'),
                ],
                (object) [
                    'nama' => 'Kos Exclusive Aluna',
                    'lokasi' => 'Antapani, Bandung',
                    'harga' => 'Rp 1.250.000 / bulan',
                    'status' => 'Aktif',
                    'kamar' => '2 kamar kosong',
                    'gambar' => asset('image/default-kos.jpg'),
                ],
            ]);

        $aktivitasTerbaru = $aktivitasTerbaru ?? [
            [
                'warna' => 'blue-dot',
                'judul' => 'Booking baru diterima',
                'deskripsi' => 'Ada 2 booking baru yang masuk hari ini dan menunggu konfirmasi dari Anda.',
            ],
            [
                'warna' => 'green-dot',
                'judul' => 'Pembayaran berhasil',
                'deskripsi' => 'Pembayaran sewa bulanan dari penyewa kamar A-03 telah berhasil diverifikasi.',
            ],
            [
                'warna' => 'orange-dot',
                'judul' => 'Kamar perlu diperbarui',
                'deskripsi' => 'Beberapa data fasilitas kamar di salah satu properti Anda belum lengkap.',
            ],
        ];
    @endphp

    <section class="dashboard-modern">

        {{-- Welcome Card --}}
        <div class="welcome-card">
            <div class="welcome-text">
                <span class="welcome-badge">
                    Panel Pemilik Kos
                </span>

                <h1>Halo, {{ $namaPemilik }} 👋</h1>
                <p>
                    Kelola properti kos Anda dengan lebih mudah. Pantau jumlah kamar tersedia, booking masuk,
                    dan aktivitas terbaru dalam satu dashboard yang ringkas.
                </p>
            </div>

            <a href="{{ route('pemilik.kos.index') }}" class="btn-primary-dashboard">
                <i class="fa-solid fa-building"></i>
                Kelola Kos
            </a>
        </div>

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon soft-blue">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h3>{{ $totalKos }}</h3>
                    <p>Total Properti Kos</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon soft-green">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <div>
                    <h3>{{ $kamarTersedia }}</h3>
                    <p>Kamar Tersedia</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon soft-orange">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <h3>{{ $bookingMasuk }}</h3>
                    <p>Booking Masuk</p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="content-grid">

            {{-- Properti Kos --}}
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h2>Properti Kos Anda</h2>
                        <p>Ringkasan kos yang sedang Anda kelola.</p>
                    </div>

                    <a href="{{ route('pemilik.kos.index') }}">Lihat semua</a>
                </div>

                <div class="modern-kos-list">
                    @forelse ($daftarKos as $kos)
                        <div class="modern-kos-item">
                            <img src="{{ $kos->gambar }}" alt="{{ $kos->nama }}">

                            <div class="modern-kos-info">
                                <h4>{{ $kos->nama }}</h4>
                                <p>{{ $kos->lokasi }}</p>

                                <div class="modern-kos-meta">
                                    <span class="price">{{ $kos->harga }}</span>
                                    <span class="tag">{{ $kos->status }}</span>
                                    <span class="tag">{{ $kos->kamar }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--muted);">
                            Belum ada data kos yang ditambahkan.
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="content-card compact-card">
                <div class="card-head">
                    <div>
                        <h2>Aktivitas Terbaru</h2>
                        <p>Pembaruan terbaru dari dashboard Anda.</p>
                    </div>
                </div>

                <ul class="modern-activity-list">
                    @forelse ($aktivitasTerbaru as $aktivitas)
                        <li>
                            <span class="activity-dot {{ $aktivitas['warna'] }}"></span>
                            <div>
                                <strong>{{ $aktivitas['judul'] }}</strong>
                                <p>{{ $aktivitas['deskripsi'] }}</p>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div>
                                <strong>Belum ada aktivitas</strong>
                                <p>Aktivitas terbaru akan muncul di sini.</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Bottom Section --}}
        <div class="content-grid">
            <div class="content-card">
                <div class="card-head">
                    <div>
                        <h2>Ringkasan Pendapatan</h2>
                        <p>Gambaran cepat performa pemasukan kos bulan ini.</p>
                    </div>
                    <a href="{{ route('pemilik.pembayaran.index') }}">Detail pembayaran</a>
                </div>

                <div class="modern-kos-list">
                    <div class="modern-kos-item">
                        <div class="modern-kos-info">
                            <h4>{{ $pendapatanBulanIni }}</h4>
                            <p>Total pemasukan bulan ini dari pembayaran penyewa yang sudah terverifikasi.</p>
                            <div class="modern-kos-meta">
                                <span class="tag">Pembayaran Valid</span>
                                <span class="tag">Bulan Ini</span>
                            </div>
                        </div>
                    </div>

                    <div class="modern-kos-item">
                        <div class="modern-kos-info">
                            <h4>Tagihan Menunggu</h4>
                            <p>Masih ada beberapa pembayaran yang menunggu konfirmasi dari penyewa.</p>
                            <div class="modern-kos-meta">
                                <span class="tag">Pending</span>
                                <span class="tag">Perlu Tinjau</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-card compact-card">
                <div class="card-head">
                    <div>
                        <h2>Aksi Cepat</h2>
                        <p>Shortcut untuk pengelolaan harian.</p>
                    </div>
                </div>

                <ul class="modern-activity-list">
                    <li>
                        <span class="activity-dot blue-dot"></span>
                        <div>
                            <strong><a href="{{ route('pemilik.kos.index') }}"
                                    style="text-decoration: none; color: inherit;">Tambah / Edit Kos</a></strong>
                            <p>Perbarui data properti, lokasi, fasilitas, dan harga sewa kos Anda.</p>
                        </div>
                    </li>

                    <li>
                        <span class="activity-dot green-dot"></span>
                        <div>
                            <strong><a href="{{ route('pemilik.booking.index') }}"
                                    style="text-decoration: none; color: inherit;">Cek Booking</a></strong>
                            <p>Lihat permintaan booking terbaru dari calon penyewa.</p>
                        </div>
                    </li>

                    <li>
                        <span class="activity-dot orange-dot"></span>
                        <div>
                            <strong><a href="{{ route('pemilik.profil') }}"
                                    style="text-decoration: none; color: inherit;">Lengkapi Profil</a></strong>
                            <p>Pastikan data profil dan informasi rekening Anda selalu lengkap.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </section>
@endsection
