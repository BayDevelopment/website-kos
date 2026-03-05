@extends('layouts.guest')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div>
                    <div class="badge">
                        <span class="dot"></span>
                        <span>Kos terkurasi untuk Cilegon & Serang</span>
                    </div>

                    <h1>Cari kos yang nyaman,<br>tanpa ribet.</h1>

                    <p class="lead">
                        RoomKos membantu kamu menemukan kos terbaik di <b>Cilegon</b> dan <b>Serang</b>.
                        Dari kos hemat untuk mahasiswa sampai kos eksklusif—semua dengan info jelas, fasilitas
                        lengkap,
                        dan lokasi yang masuk akal.
                    </p>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#rekomendasi"><span><i class="fa-solid fa-house"></i></span> Lihat kos
                            rekomendasi</a>
                        <a class="btn" href="#cara"><span> <i class="fa-solid fa-circle-info"></i></span> Cara
                            kerja</a>
                    </div>

                    <div class="subnote">
                        ✨ Listing update cepat • 📍 Fokus area Cilegon & Serang • 🔒 Pemilik kos terverifikasi
                    </div>
                </div>

                <aside class="panel" aria-label="Pencarian kos">
                    <div class="panel-inner">
                        <h3>Cari kos sekarang</h3>
                        <p>Filter cepat biar ketemu yang pas.</p>

                        <form class="form" method="GET" action="{{ url('/kos') }}">
                            <div class="field">
                                <label for="kota">Kota</label>
                                <select id="kota" name="kota">
                                    <option value="cilegon">Cilegon</option>
                                    <option value="serang">Serang</option>
                                </select>
                            </div>

                            <div class="field">
                                <label for="tipe">Tipe</label>
                                <select id="tipe" name="tipe">
                                    <option value="">Semua</option>
                                    <option value="putra">Putra</option>
                                    <option value="putri">Putri</option>
                                    <option value="campur">Campur</option>
                                </select>
                            </div>

                            <div class="field">
                                <label for="min">Budget min</label>
                                <input id="min" name="min" placeholder="mis. 500000" inputmode="numeric">
                            </div>

                            <div class="field">
                                <label for="max">Budget max</label>
                                <input id="max" name="max" placeholder="mis. 1500000" inputmode="numeric">
                            </div>

                            <div class="field full">
                                <label for="keyword">Kata kunci</label>
                                <input id="keyword" name="q" placeholder="mis. dekat kampus, AC, wifi">
                            </div>

                            <div class="full">
                                <button class="btn btn-primary" style="width:100%" type="submit"><span><i
                                            class="fa-solid fa-magnifying-glass"></i></span> Cari kos</button>
                            </div>
                        </form>

                        <div class="chips" aria-label="Quick filters">
                            <span class="chip">WiFi</span>
                            <span class="chip">AC</span>
                            <span class="chip">KM dalam</span>
                            <span class="chip">Dekat kampus</span>
                            <span class="chip">Parkir motor</span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="section" id="rekomendasi">
        <div class="container">
            <div class="section-title">
                <div>
                    <h2>Rekomendasi kos hari ini</h2>
                    <p>Contoh tampilan kartu listing. Nanti tinggal loop dari database.</p>
                </div>
                <a class="btn" href="{{ url('/kos') }}"><span><i class="fa-solid fa-building"></i></span> Lihat
                    semua</a>
            </div>

            <div class="grid kos-grid">
                <article class="card kos-card" data-images="/images/kos/1a.jpg,/images/kos/1b.jpg,/images/kos/1c.jpg">
                    <div class="kos-media">
                        <img class="kos-img" alt="Kos Lavender">
                        <button class="nav prev" type="button" aria-label="Sebelumnya">‹</button>
                        <button class="nav next" type="button" aria-label="Berikutnya">›</button>
                        <div class="dots" aria-hidden="true"></div>

                        <div class="badge-top">
                            <span class="tag">Cilegon • Putri</span>
                        </div>
                    </div>

                    <div class="kos-body">
                        <div class="card-top">
                            <span class="price">Rp 900rb/bulan</span>
                        </div>
                        <h3>Kos Lavender — Dekat pusat kota</h3>
                        <div class="meta">
                            <span>📶 WiFi</span><span>❄️ AC</span><span>🚿 KM dalam</span>
                        </div>

                        <div class="kos-actions">
                            <a class="btn btn-primary" href="{{ url('/kos/1') }}"><span><i
                                        class="fa-solid fa-eye"></i></span> Lihat detail</a>
                            <a class="btn" href="{{ url('/kos/1') }}#lokasi"><span><i
                                        class="fa-solid fa-location-dot"></i></span> Lokasi</a>
                        </div>
                    </div>
                </article>

                <article class="card kos-card" data-images="/images/kos/2a.jpg,/images/kos/2b.jpg">
                    <div class="kos-media">
                        <img class="kos-img" alt="Kos Skyline">
                        <button class="nav prev" type="button" aria-label="Sebelumnya">‹</button>
                        <button class="nav next" type="button" aria-label="Berikutnya">›</button>
                        <div class="dots" aria-hidden="true"></div>
                        <div class="badge-top">
                            <span class="tag">Serang • Putra</span>
                        </div>
                    </div>

                    <div class="kos-body">
                        <div class="card-top">
                            <span class="price">Rp 650rb/bulan</span>
                        </div>
                        <h3>Kos Skyline — Akses cepat ke kampus</h3>
                        <div class="meta">
                            <span>📶 WiFi</span><span>🅿️ Parkir</span><span>🧺 Laundry</span>
                        </div>

                        <div class="kos-actions">
                            <a class="btn btn-primary" href="{{ url('/kos/2') }}"><span><i
                                        class="fa-solid fa-eye"></i></span> Lihat detail</a>
                            <a class="btn" href="{{ url('/kos/2') }}#lokasi"><span><i
                                        class="fa-solid fa-location-dot"></i></span> Lokasi</a>
                        </div>
                    </div>
                </article>

                <article class="card kos-card" data-images="/images/kos/3a.jpg,/images/kos/3b.jpg,/images/kos/3c.jpg">
                    <div class="kos-media">
                        <img class="kos-img" alt="Kos Neo">
                        <button class="nav prev" type="button" aria-label="Sebelumnya">‹</button>
                        <button class="nav next" type="button" aria-label="Berikutnya">›</button>
                        <div class="dots" aria-hidden="true"></div>
                        <div class="badge-top">
                            <span class="tag">Cilegon • Campur</span>
                        </div>
                    </div>

                    <div class="kos-body">
                        <div class="card-top">
                            <span class="price">Rp 1.2jt/bulan</span>
                        </div>
                        <h3>Kos Neo — Nyaman & tenang</h3>
                        <div class="meta">
                            <span>❄️ AC</span><span>🚿 KM dalam</span><span>🔐 Keamanan</span>
                        </div>

                        <div class="kos-actions">
                            <a class="btn btn-primary" href="{{ url('/kos/3') }}"><span><i
                                        class="fa-solid fa-eye"></i></span> Lihat detail</a>
                            <a class="btn" href="{{ url('/kos/3') }}#lokasi"><span><i
                                        class="fa-solid fa-location-dot"></i></span> Lokasi</a>
                        </div>
                    </div>
                </article>
            </div>

            <div class="cta" id="mulai">
                <div>
                    <h3>Butuh kos cepat? Tinggal 3 langkah.</h3>
                    <p>Search → bandingin fasilitas → chat pemilik / booking (sesuai fitur yang kamu bikin).</p>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap">
                    <a class="btn" href="{{ url('/kos') }}">
                        <span><i class="fa-solid fa-magnifying-glass"></i></span> Mulai cari kos
                    </a>

                    <a class="btn btn-primary" href="{{ route('mahasiswa.register') }}">
                        <span><i class="fa-solid fa-user-plus"></i></span> Daftar gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="kenapa">
        <div class="container">
            <div class="section-title">
                <div>
                    <h2>Kenapa RoomKos?</h2>
                    <p>Fokus lokal, informasi jelas, dan pengalaman yang enak dipakai.</p>
                </div>
            </div>

            <div class="features">
                <div class="feature">
                    <b>Fokus Cilegon & Serang</b>
                    <p>Listing lebih relevan, pencarian lebih cepat, dan rekomendasi lebih “ngena” buat kebutuhan
                        kamu.</p>
                </div>
                <div class="feature">
                    <b>Detail transparan</b>
                    <p>Harga, fasilitas, aturan kos, sampai info lokasi—dibuat jelas supaya minim drama pas survei.
                    </p>
                </div>
                <div class="feature">
                    <b>Desain modern</b>
                    <p>UI clean, elegan, dan ringan. Dari HP sampai laptop tetap nyaman.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="cara">
        <div class="container">

            <div class="section-title">
                <div>
                    <h2>Cara Kerja RoomKos</h2>
                    <p>Temukan kos impianmu hanya dalam beberapa langkah mudah.</p>
                </div>
            </div>

            <div class="accordion">

                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari kos sesuai kebutuhan
                        </span>
                        <i class="fa-solid fa-chevron-down accordion-icon"></i>
                    </button>

                    <div class="accordion-content">
                        Gunakan fitur pencarian untuk menemukan kos berdasarkan kota,
                        harga, dan fasilitas yang kamu inginkan.
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-eye"></i>
                            Lihat detail kos
                        </span>
                        <i class="fa-solid fa-chevron-down accordion-icon"></i>
                    </button>

                    <div class="accordion-content">
                        Lihat foto kamar, fasilitas, lokasi, serta informasi penting
                        lainnya sebelum kamu memutuskan.
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header" type="button" aria-expanded="false">
                        <span>
                            <i class="fa-solid fa-comment"></i>
                            Hubungi pemilik kos
                        </span>
                        <i class="fa-solid fa-chevron-down accordion-icon"></i>
                    </button>

                    <div class="accordion-content">
                        Jika cocok, kamu bisa langsung menghubungi pemilik kos
                        untuk menanyakan ketersediaan atau melakukan booking.
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@push('styles')
    <style>
        /* grid responsive untuk card */
        .kos-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        @media (max-width: 1024px) {
            .kos-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .kos-grid {
                grid-template-columns: 1fr;
            }
        }

        /* card */
        .kos-card {
            overflow: hidden;
            padding: 0;
            /* biar media full */
        }

        /* media / gambar */
        .kos-media {
            position: relative;
            aspect-ratio: 16 / 10;
            background: rgba(15, 23, 42, .04);
            border-bottom: 1px solid var(--stroke, #e5e7eb);
        }

        .kos-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            opacity: 0;
            transform: scale(1.02);
            transition: opacity .35s ease, transform .5s ease;
        }

        .kos-img.is-ready {
            opacity: 1;
            transform: scale(1);
        }

        /* badge tag di atas foto */
        .badge-top {
            position: absolute;
            left: 12px;
            top: 12px;
            display: flex;
            gap: 8px;
        }

        /* nav arrows */
        .kos-media .nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .55);
            background: rgba(255, 255, 255, .75);
            backdrop-filter: blur(6px);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #0f172a;
            transition: .15s ease;
            opacity: 0;
        }

        .kos-media:hover .nav {
            opacity: 1;
        }

        .kos-media .nav:hover {
            transform: translateY(-50%) scale(1.04);
        }

        .kos-media .prev {
            left: 10px;
        }

        .kos-media .next {
            right: 10px;
        }

        /* dots */
        .dots {
            position: absolute;
            left: 50%;
            bottom: 10px;
            transform: translateX(-50%);
            display: flex;
            gap: 6px;
            padding: 6px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .70);
            border: 1px solid rgba(255, 255, 255, .55);
            opacity: .95;
        }

        .dots button {
            width: 7px;
            height: 7px;
            border-radius: 99px;
            border: none;
            padding: 0;
            cursor: pointer;
            background: rgba(15, 23, 42, .28);
        }

        .dots button.active {
            background: rgba(15, 23, 42, .75);
        }

        /* body content */
        .kos-body {
            padding: 16px;
        }

        .kos-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        /* fade-in saat card masuk viewport */
        .kos-card.reveal {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity .5s ease, transform .5s ease;
        }

        .kos-card.reveal.is-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* accordion container */
        .accordion {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* item */
        .accordion-item {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        /* header */
        .accordion-header {
            width: 100%;
            padding: 16px 18px;
            background: #fff;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            cursor: pointer;
            font-size: 15px;
        }

        .accordion-header span {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* hover */
        .accordion-header:hover {
            background: #f8fafc;
        }

        /* content */
        .accordion-content {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: all .3s ease;
            color: #64748b;
            font-size: 14px;
        }

        /* active state */
        .accordion-item.active .accordion-content {
            padding: 14px 18px;
            max-height: 200px;
        }

        .accordion-icon {
            transition: transform .3s ease;
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* =========================
               Reveal on scroll
            ========================= */
            const revealCards = () => {
                const cards = document.querySelectorAll('.kos-card.reveal');
                if (!('IntersectionObserver' in window)) {
                    cards.forEach(c => c.classList.add('is-in'));
                    return;
                }
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-in');
                            io.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15
                });
                cards.forEach(card => io.observe(card));
            };

            /* =========================
               Card carousel
            ========================= */
            const initCardCarousel = (card) => {
                const imgEl = card.querySelector('.kos-img');
                const prevBtn = card.querySelector('.prev');
                const nextBtn = card.querySelector('.next');
                const dotsWrap = card.querySelector('.dots');
                const media = card.querySelector('.kos-media');
                if (!imgEl || !media) return;

                const images = (card.dataset.images || '')
                    .split(',')
                    .map(s => s.trim())
                    .filter(Boolean);

                if (!images.length) return;

                let idx = 0;
                let timer = null;

                const renderDots = () => {
                    if (!dotsWrap) return;
                    dotsWrap.innerHTML = '';
                    images.forEach((_, i) => {
                        const b = document.createElement('button');
                        b.type = 'button';
                        b.className = i === idx ? 'active' : '';
                        b.addEventListener('click', () => show(i, true));
                        dotsWrap.appendChild(b);
                    });
                };

                const show = (i, userAction = false) => {
                    idx = (i + images.length) % images.length;
                    imgEl.classList.remove('is-ready');

                    const tmp = new Image();
                    tmp.onload = () => {
                        imgEl.src = images[idx];
                        imgEl.classList.add('is-ready');
                        renderDots();
                    };
                    tmp.src = images[idx];

                    if (userAction && timer) {
                        clearInterval(timer);
                        timer = null;
                    }
                };

                prevBtn && prevBtn.addEventListener('click', () => show(idx - 1, true));
                nextBtn && nextBtn.addEventListener('click', () => show(idx + 1, true));

                let startX = 0;
                media.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                }, {
                    passive: true
                });

                media.addEventListener('touchend', (e) => {
                    const endX = e.changedTouches[0].clientX;
                    const diff = endX - startX;
                    if (Math.abs(diff) > 40) {
                        diff < 0 ? show(idx + 1, true) : show(idx - 1, true);
                    }
                }, {
                    passive: true
                });

                show(0);

                if (images.length > 1) {
                    timer = setInterval(() => show(idx + 1), 4500);
                    card.addEventListener('mouseenter', () => timer && clearInterval(timer));
                    card.addEventListener('mouseleave', () => {
                        timer = setInterval(() => show(idx + 1), 4500);
                    });
                } else {
                    prevBtn && (prevBtn.style.display = 'none');
                    nextBtn && (nextBtn.style.display = 'none');
                    dotsWrap && (dotsWrap.style.display = 'none');
                }
            };

            document.querySelectorAll('.kos-card').forEach(card => card.classList.add('reveal'));
            revealCards();
            document.querySelectorAll('.kos-card').forEach(initCardCarousel);

            /* =========================
               Accordion (FINAL)
            ========================= */
            document.querySelectorAll('.accordion-header').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const item = btn.closest('.accordion-item');
                    if (!item) return;

                    const isOpen = item.classList.contains('active');

                    // close all
                    document.querySelectorAll('.accordion-item').forEach((el) => {
                        el.classList.remove('active');
                        const h = el.querySelector('.accordion-header');
                        if (h) h.setAttribute('aria-expanded', 'false');
                    });

                    // open clicked if previously closed
                    if (!isOpen) {
                        item.classList.add('active');
                        btn.setAttribute('aria-expanded', 'true');
                    }
                });
            });

        });
    </script>
@endpush
