@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="p-6">

        <div class="content-card">

            <div class="card-head">
                <div>
                    <h2>Tambah Kos</h2>
                    <p>Tambahkan properti kos baru yang kamu miliki</p>
                </div>
            </div>

            <form action="{{ route('pemilik.kos.insert') }}" method="POST">

                @csrf

                <div class="form-grid">

                    {{-- NAMA KOS --}}
                    <div class="form-group required">
                        <label>Nama Kos</label>
                        <input type="text" name="nama_kos" placeholder="Contoh: Kos Melati Cilegon" required>
                    </div>

                    {{-- SLUG --}}
                    <div class="form-group">
                        <label>Slug (URL)</label>
                        <input type="text" id="slug_display" readonly placeholder="Slug otomatis dari nama kos">
                    </div>

                    {{-- TIPE KOS --}}
                    <div class="form-group required">
                        <label>Tipe Kos</label>
                        <select name="tipe_kos" required>
                            <option value="">-- Pilih tipe kos --</option>
                            <option value="putra">Kos Putra</option>
                            <option value="putri">Kos Putri</option>
                            <option value="campur">Kos Campur</option>
                        </select>
                    </div>

                    {{-- JENIS SEWA --}}
                    <div class="form-group required">
                        <label>Jenis Sewa</label>
                        <select name="jenis_sewa" required>
                            <option value="harian">Harian</option>
                            <option value="bulanan" selected>Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>

                    {{-- HARGA --}}
                    <div class="form-group">
                        <label>Harga Mulai</label>
                        <input type="number" name="harga_mulai" placeholder="Contoh: 500000">
                    </div>

                    <div class="form-group required">
                        <label>Provinsi</label>
                        <select id="provinsi" name="provinsi" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    <div class="form-group required">
                        <label>Kota</label>
                        <select id="kota" name="kota" required>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>

                    <div class="form-group required">
                        <label>Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan</label>
                        <select id="kelurahan" name="kelurahan">
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>

                    {{-- KODE POS --}}
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" placeholder="Contoh: 42423">
                    </div>

                    {{-- KONTAK NAMA --}}
                    <div class="form-group">
                        <label>Nama Kontak</label>
                        <input type="text" name="kontak_nama" placeholder="Contoh: Bapak Andi">
                    </div>

                    {{-- KONTAK WA --}}
                    <div class="form-group">
                        <label>No WhatsApp</label>
                        <input type="text" name="kontak_wa" placeholder="Contoh: 081234567890">
                    </div>

                </div>

                <div class="form-group full">
                    <label>Lokasi Kos</label>
                    <div id="map" style="height:350px;border-radius:12px; margin-bottom: 10px;"></div>
                </div>

                <input type="hidden" name="latitude">
                <input type="hidden" name="longitude">

                <div class="form-group required full">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" required></textarea>
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group full">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="4" placeholder="Jelaskan fasilitas, lingkungan, dan keunggulan kos..."></textarea>
                </div>

                <div class="form-actions">

                    <button type="submit" class="btn-submit-kos">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Kos</span>
                    </button>

                    <a href="{{ route('pemilik.kos.index') }}" class="btn-cancel">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection


@push('styles')
    <style>
        /* GRID FORM */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        /* LABEL */

        .form-group label {
            font-size: 14px;
            font-weight: 600;
        }

        /* REQUIRED STAR */

        .form-group.required label::after {
            content: " *";
            color: #dc2626;
        }

        /* INPUT */

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 11px 12px;
            border-radius: 12px;
            border: 1px solid var(--line);
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            transition: .2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        /* ACTION */

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            padding: 12px 16px;
            border-radius: 14px;
            text-decoration: none;
            background: #f3f4f6;
            color: #374151;
        }

        /* RESPONSIVE */

        @media(max-width:768px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

        }
    </style>
@endpush
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            "use strict";

            /* =========================
               ELEMENT
            ========================= */

            const namaKos = document.querySelector('[name="nama_kos"]');
            const slugDisplay = document.getElementById("slug_display");
            const slugHidden = document.getElementById("slug");

            const provinsi = document.getElementById("provinsi");
            const kota = document.getElementById("kota");
            const kecamatan = document.getElementById("kecamatan");
            const kelurahan = document.getElementById("kelurahan");

            const form = document.querySelector("form");


            /* =========================
               PREVENT DOUBLE SUBMIT
            ========================= */

            if (form) {

                form.addEventListener("submit", function() {

                    const btn = form.querySelector("button[type=submit]");

                    if (btn) {
                        btn.disabled = true;
                        btn.innerText = "Menyimpan...";
                    }

                });

            }


            /* =========================
               AUTO SLUG (CLIENT PREVIEW)
            ========================= */

            if (namaKos && slugDisplay && slugHidden) {

                const slugify = (text) => {

                    return text
                        .normalize("NFKD")
                        .replace(/[\u0300-\u036f]/g, "")
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, "")
                        .replace(/\s+/g, "-")
                        .replace(/-+/g, "-")
                        .replace(/^-+|-+$/g, "")
                        .substring(0, 120);

                };

                let typingTimer;

                namaKos.addEventListener("input", function() {

                    clearTimeout(typingTimer);

                    typingTimer = setTimeout(() => {

                        const slug = slugify(this.value);

                        slugDisplay.value = slug || "";
                        slugHidden.value = slug || "";

                    }, 150);

                });

            }


            /* =========================
               API WILAYAH
            ========================= */

            if (!provinsi || !kota || !kecamatan || !kelurahan) return;

            const API = "https://www.emsifa.com/api-wilayah-indonesia/api";


            /* =========================
               HELPER
            ========================= */

            function resetSelect(el, label) {

                el.innerHTML = `<option value="">${label}</option>`;

            }

            function loading(el) {

                el.innerHTML = `<option value="">Loading...</option>`;

            }


            /* =========================
               LOAD PROVINSI
            ========================= */

            async function loadProvinsi() {

                try {

                    const res = await fetch(`${API}/provinces.json`);

                    if (!res.ok) throw new Error("API Error");

                    const data = await res.json();

                    let html = `<option value="">Pilih Provinsi</option>`;

                    data.forEach(p => {

                        if (p.name.toLowerCase() === "banten") {

                            html +=
                                `<option value="${p.name}" data-id="${p.id}" selected>${p.name}</option>`;

                        }

                    });

                    provinsi.innerHTML = html;

                    loadKota();

                } catch (err) {

                    console.error("Gagal load provinsi", err);

                    resetSelect(provinsi, "Provinsi gagal dimuat");

                }

            }


            /* =========================
               LOAD KOTA
            ========================= */

            async function loadKota() {

                const provId = provinsi.options[provinsi.selectedIndex]?.dataset.id;

                if (!provId) return;

                loading(kota);

                try {

                    const res = await fetch(`${API}/regencies/${provId}.json`);

                    if (!res.ok) throw new Error("API Error");

                    const data = await res.json();

                    let html = `<option value="">Pilih Kota</option>`;

                    data.forEach(k => {

                        const name = k.name.toUpperCase();

                        if (name.includes("CILEGON") || name.includes("SERANG")) {

                            html += `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`;

                        }

                    });

                    kota.innerHTML = html;

                } catch (err) {

                    console.error("Gagal load kota", err);

                    resetSelect(kota, "Kota gagal dimuat");

                }

            }


            /* =========================
               LOAD KECAMATAN
            ========================= */

            async function loadKecamatan() {

                const kotaId = kota.options[kota.selectedIndex]?.dataset.id;

                if (!kotaId) return;

                loading(kecamatan);

                resetSelect(kelurahan, "Pilih Kelurahan");

                try {

                    const res = await fetch(`${API}/districts/${kotaId}.json`);

                    if (!res.ok) throw new Error("API Error");

                    const data = await res.json();

                    let html = `<option value="">Pilih Kecamatan</option>`;

                    data.forEach(kec => {

                        html += `<option value="${kec.name}" data-id="${kec.id}">${kec.name}</option>`;

                    });

                    kecamatan.innerHTML = html;

                } catch (err) {

                    console.error("Gagal load kecamatan", err);

                    resetSelect(kecamatan, "Kecamatan gagal dimuat");

                }

            }


            /* =========================
               LOAD KELURAHAN
            ========================= */

            async function loadKelurahan() {

                const kecId = kecamatan.options[kecamatan.selectedIndex]?.dataset.id;

                if (!kecId) return;

                loading(kelurahan);

                try {

                    const res = await fetch(`${API}/villages/${kecId}.json`);

                    if (!res.ok) throw new Error("API Error");

                    const data = await res.json();

                    let html = `<option value="">Pilih Kelurahan</option>`;

                    data.forEach(kel => {

                        html += `<option value="${kel.name}">${kel.name}</option>`;

                    });

                    kelurahan.innerHTML = html;

                } catch (err) {

                    console.error("Gagal load kelurahan", err);

                    resetSelect(kelurahan, "Kelurahan gagal dimuat");

                }

            }


            /* =========================
               EVENT
            ========================= */

            provinsi.addEventListener("change", () => {

                resetSelect(kota, "Pilih Kota");
                resetSelect(kecamatan, "Pilih Kecamatan");
                resetSelect(kelurahan, "Pilih Kelurahan");

                loadKota();

            });

            kota.addEventListener("change", loadKecamatan);

            kecamatan.addEventListener("change", loadKelurahan);


            /* =========================
            MAP PICKER + AUTO ADDRESS
            ========================= */

            const mapElement = document.getElementById("map");

            if (mapElement) {

                const map = L.map("map").setView([-6.0023, 106.0112], 13);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 19
                }).addTo(map);

                let marker = null;

                const latInput = document.querySelector('[name="latitude"]');
                const lngInput = document.querySelector('[name="longitude"]');
                const alamatTextarea = document.querySelector('[name="alamat_lengkap"]');

                map.on("click", async function(e) {

                    const lat = e.latlng.lat.toFixed(8);
                    const lng = e.latlng.lng.toFixed(8);

                    /* marker */

                    if (marker) {
                        marker.setLatLng(e.latlng);
                    } else {
                        marker = L.marker(e.latlng).addTo(map);
                    }

                    /* isi latitude longitude */

                    if (latInput) latInput.value = lat;
                    if (lngInput) lngInput.value = lng;

                    /* reverse geocode */

                    try {

                        const url =
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

                        const res = await fetch(url, {
                            headers: {
                                "Accept": "application/json"
                            }
                        });

                        const data = await res.json();

                        if (data && data.display_name && alamatTextarea) {

                            alamatTextarea.value = data.display_name;

                        }

                    } catch (err) {

                        console.error("Gagal ambil alamat", err);

                    }

                });

            }


            /* =========================
               INIT
            ========================= */

            loadProvinsi();

        });
    </script>
@endpush
