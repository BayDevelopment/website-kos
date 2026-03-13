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
                        <input type="hidden" id="slug" name="slug">
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

                    {{-- WILAYAH --}}
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

                    {{-- KONTAK --}}
                    <div class="form-group">
                        <label>Nama Kontak</label>
                        <input type="text" name="kontak_nama" placeholder="Contoh: Bapak Andi">
                    </div>
                    <div class="form-group">
                        <label>No WhatsApp</label>
                        <input type="text" name="kontak_wa" placeholder="Contoh: 081234567890">
                    </div>

                </div>

                {{-- MAP --}}
                <div class="form-group full">
                    <label>Lokasi Kos</label>
                    @error('latitude')
                        <div class="alert-map-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            Silakan klik lokasi kos di peta terlebih dahulu.
                        </div>
                    @enderror
                    <div id="map" style="height:350px;border-radius:12px; margin-bottom: 10px;"></div>
                    <small style="color:#6b7280">Klik peta untuk menentukan lokasi kos.</small>
                </div>
                <input type="hidden" name="latitude">
                <input type="hidden" name="longitude">

                {{-- ALAMAT --}}
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
                    <a href="{{ route('pemilik.kos.index') }}" class="btn-cancel">Batal</a>
                </div>

            </form>

        </div>
    </div>
@endsection
@push('styles')
    <style>
        .alert-map-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 10px;
        }

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

        .btn-submit-kos {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 12px 18px;
            border-radius: 14px;
            border: none;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: .2s;
            font-family: "Poppins", sans-serif !important;
        }

        .btn-submit-kos:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .08);
        }
    </style>
@endpush
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            "use strict";

            // Auto slug
            const namaKos = document.querySelector('[name="nama_kos"]');
            const slugDisplay = document.getElementById("slug_display");
            const slugHidden = document.getElementById("slug");
            if (namaKos) {
                const slugify = text => text.normalize("NFKD").replace(/[\u0300-\u036f]/g, "").toLowerCase().trim()
                    .replace(/[^a-z0-9\s-]/g, "").replace(/\s+/g, "-").replace(/-+/g, "-").replace(/^-+|-+$/g, "")
                    .substring(0, 120);
                namaKos.addEventListener("input", () => {
                    const slug = slugify(namaKos.value);
                    slugDisplay.value = slug;
                    slugHidden.value = slug;
                });
            }

            // Prevent double submit
            const form = document.querySelector("form");
            if (form) {
                form.addEventListener("submit", () => {
                    const btn = form.querySelector("button[type=submit]");
                    if (btn) {
                        btn.disabled = true;
                        btn.innerText = "Menyimpan...";
                    }
                });
            }

            // Wilayah
            const provinsi = document.getElementById("provinsi");
            const kota = document.getElementById("kota");
            const kecamatan = document.getElementById("kecamatan");
            const kelurahan = document.getElementById("kelurahan");
            const API = "https://www.emsifa.com/api-wilayah-indonesia/api";

            function resetSelect(el, label) {
                el.innerHTML = `<option value="">${label}</option>`;
            }

            function loading(el) {
                el.innerHTML = `<option value="">Loading...</option>`;
            }

            async function loadProvinsi() {
                try {
                    const res = await fetch(`${API}/provinces.json`);
                    const data = await res.json();
                    let html = `<option value="">Pilih Provinsi</option>`;
                    data.forEach(p => {
                        html += `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`;
                    });
                    provinsi.innerHTML = html;
                } catch (e) {
                    console.error(e);
                    resetSelect(provinsi, "Provinsi gagal dimuat");
                }
            }

            async function loadKota() {
                const provId = provinsi.options[provinsi.selectedIndex]?.dataset.id;
                if (!provId) return;
                loading(kota);
                const res = await fetch(`${API}/regencies/${provId}.json`);
                const data = await res.json();
                let html = `<option value="">Pilih Kota</option>`;
                data.forEach(k => html += `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`);
                kota.innerHTML = html;
                resetSelect(kecamatan, "Pilih Kecamatan");
                resetSelect(kelurahan, "Pilih Kelurahan");
            }

            async function loadKecamatan() {
                const kotaId = kota.options[kota.selectedIndex]?.dataset.id;
                if (!kotaId) return;
                loading(kecamatan);
                resetSelect(kelurahan, "Pilih Kelurahan");
                const res = await fetch(`${API}/districts/${kotaId}.json`);
                const data = await res.json();
                let html = `<option value="">Pilih Kecamatan</option>`;
                data.forEach(k => html += `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`);
                kecamatan.innerHTML = html;
            }

            async function loadKelurahan() {
                const kecId = kecamatan.options[kecamatan.selectedIndex]?.dataset.id;
                if (!kecId) return;
                loading(kelurahan);
                const res = await fetch(`${API}/villages/${kecId}.json`);
                const data = await res.json();
                let html = `<option value="">Pilih Kelurahan</option>`;
                data.forEach(k => html += `<option value="${k.name}">${k.name}</option>`);
                kelurahan.innerHTML = html;
            }

            provinsi.addEventListener("change", loadKota);
            kota.addEventListener("change", loadKecamatan);
            kecamatan.addEventListener("change", loadKelurahan);

            loadProvinsi();

            // Map picker
            const map = L.map("map").setView([-6.0023, 106.0112], 13);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19
            }).addTo(map);
            let marker = null;
            const latInput = document.querySelector('[name="latitude"]');
            const lngInput = document.querySelector('[name="longitude"]');
            const alamatTextarea = document.querySelector('[name="alamat_lengkap"]');

            map.on("click", async e => {
                const lat = e.latlng.lat.toFixed(8);
                const lng = e.latlng.lng.toFixed(8);
                if (marker) marker.setLatLng(e.latlng);
                else marker = L.marker(e.latlng).addTo(map);
                latInput.value = lat;
                lngInput.value = lng;
                try {
                    const res = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
                    );
                    const data = await res.json();
                    if (data.display_name) alamatTextarea.value = data.display_name;
                } catch (err) {
                    console.error(err);
                }
            });

        });
    </script>
@endpush
