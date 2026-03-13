@extends('layouts.pemilik')
@section('content_pemilik')
    <div class="p-6">

        <div class="content-card">

            <div class="card-head">
                <div>
                    <h2>Edit Kos</h2>
                    <p>Perbarui properti kos yang kamu miliki</p>
                </div>
            </div>

            <form action="{{ route('pemilik.kos.update', $kos->slug) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- NAMA KOS --}}
                    <div class="form-group required">
                        <label>Nama Kos</label>
                        <input type="text" name="nama_kos" value="{{ old('nama_kos', $kos->nama_kos) }}" required>
                    </div>

                    {{-- SLUG --}}
                    <div class="form-group">
                        <label>Slug (URL)</label>
                        <input type="text" id="slug_display" value="{{ $kos->slug }}" readonly>
                        <input type="hidden" id="slug" name="slug" value="{{ $kos->slug }}">
                    </div>

                    {{-- TIPE KOS --}}
                    <div class="form-group required">
                        <label>Tipe Kos</label>
                        <select name="tipe_kos" required>
                            <option value="">-- Pilih tipe kos --</option>
                            <option value="putra" {{ old('tipe_kos', $kos->tipe_kos) == 'putra' ? 'selected' : '' }}>Kos
                                Putra
                            </option>
                            <option value="putri" {{ old('tipe_kos', $kos->tipe_kos) == 'putri' ? 'selected' : '' }}>Kos
                                Putri
                            </option>
                            <option value="campur" {{ old('tipe_kos', $kos->tipe_kos) == 'campur' ? 'selected' : '' }}>Kos
                                Campur
                            </option>
                        </select>
                    </div>

                    {{-- JENIS SEWA --}}
                    <div class="form-group required">
                        <label>Jenis Sewa</label>
                        <select name="jenis_sewa" required>
                            <option value="harian" {{ old('jenis_sewa', $kos->jenis_sewa) == 'harian' ? 'selected' : '' }}>
                                Harian
                            </option>
                            <option value="bulanan"
                                {{ old('jenis_sewa', $kos->jenis_sewa) == 'bulanan' ? 'selected' : '' }}>
                                Bulanan</option>
                            <option value="tahunan"
                                {{ old('jenis_sewa', $kos->jenis_sewa) == 'tahunan' ? 'selected' : '' }}>
                                Tahunan</option>
                        </select>
                    </div>

                    {{-- HARGA --}}
                    <div class="form-group">
                        <label>Harga Mulai</label>
                        <input type="number" name="harga_mulai" value="{{ old('harga_mulai', $kos->harga_mulai) }}">
                    </div>

                    {{-- PROVINSI --}}
                    <div class="form-group required">
                        <label>Provinsi</label>
                        <select id="provinsi" name="provinsi" required>
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    {{-- KOTA --}}
                    <div class="form-group required">
                        <label>Kota</label>
                        <select id="kota" name="kota" required>
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>

                    {{-- KECAMATAN --}}
                    <div class="form-group required">
                        <label>Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>

                    {{-- KELURAHAN --}}
                    <div class="form-group">
                        <label>Kelurahan</label>
                        <select id="kelurahan" name="kelurahan">
                            <option value="">Pilih Kelurahan</option>
                        </select>
                    </div>

                    {{-- KODE POS --}}
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $kos->kode_pos) }}">
                    </div>

                    {{-- KONTAK --}}
                    <div class="form-group">
                        <label>Nama Kontak</label>
                        <input type="text" name="kontak_nama" value="{{ old('kontak_nama', $kos->kontak_nama) }}">
                    </div>
                    <div class="form-group">
                        <label>No WhatsApp</label>
                        <input type="text" name="kontak_wa" value="{{ old('kontak_wa', $kos->kontak_wa) }}">
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
                    <small style="color:#6b7280">
                        Klik peta untuk menentukan lokasi kos.
                    </small>
                </div>

                <input type="hidden" name="latitude" value="{{ old('latitude', $kos->latitude) }}">
                <input type="hidden" name="longitude" value="{{ old('longitude', $kos->longitude) }}">

                {{-- ALAMAT --}}
                <div class="form-group required full">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" required>{{ old('alamat_lengkap', $kos->alamat_lengkap) }}</textarea>
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group full">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="4">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit-kos">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Update Kos</span>
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
        .custom-file-input {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 8px 12px;
            cursor: pointer;
            transition: 0.2s;
        }

        .custom-file-input:hover {
            border-color: var(--primary);
        }

        .btn-choose {
            background: var(--primary);
            color: #fff;
            padding: 6px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .file-name {
            font-size: 14px;
            color: #374151;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 250px;
        }

        .file-info {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
            display: block;
        }

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
            grid-column: 1/-1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
        }

        .form-group.required label::after {
            content: " *";
            color: #dc2626;
        }

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

        /* MAP */

        #map {
            height: 350px;
            border-radius: 12px;
            margin-top: 8px;
        }

        .map-info {
            color: #6b7280;
            font-size: 13px;
        }

        /* ACTION BUTTON */

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
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

        .btn-cancel {
            padding: 12px 16px;
            border-radius: 14px;
            text-decoration: none;
            background: #f3f4f6;
            color: #374151;
        }

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

            const provinsi = document.getElementById("provinsi");
            const kota = document.getElementById("kota");
            const kecamatan = document.getElementById("kecamatan");
            const kelurahan = document.getElementById("kelurahan");

            const latInput = document.querySelector('[name="latitude"]');
            const lngInput = document.querySelector('[name="longitude"]');
            const alamatTextarea = document.querySelector('[name="alamat_lengkap"]');

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
               INIT FROM DATABASE
            ========================= */
            function initFromDB() {
                if ("{{ $kos->provinsi }}") {
                    provinsi.innerHTML =
                        `<option value="{{ $kos->provinsi }}" selected>{{ $kos->provinsi }}</option>`;
                }
                if ("{{ $kos->kota }}") {
                    kota.innerHTML = `<option value="{{ $kos->kota }}" selected>{{ $kos->kota }}</option>`;
                }
                if ("{{ $kos->kecamatan }}") {
                    kecamatan.innerHTML =
                        `<option value="{{ $kos->kecamatan }}" selected>{{ $kos->kecamatan }}</option>`;
                }
                if ("{{ $kos->kelurahan }}") {
                    kelurahan.innerHTML =
                        `<option value="{{ $kos->kelurahan }}" selected>{{ $kos->kelurahan }}</option>`;
                }
            }

            initFromDB();

            /* =========================
               LOAD API WHEN USER CHANGES
            ========================= */
            async function loadProvinsiAPI() {
                try {
                    const res = await fetch(`${API}/provinces.json`);
                    const data = await res.json();
                    resetSelect(provinsi, "Pilih Provinsi");
                    data.forEach(p => provinsi.innerHTML +=
                        `<option value="${p.name}" data-id="${p.id}">${p.name}</option>`);
                } catch (err) {
                    console.error(err);
                }
            }

            async function loadKotaAPI() {
                const provId = provinsi.options[provinsi.selectedIndex]?.dataset.id;
                if (!provId) return;
                loading(kota);
                const res = await fetch(`${API}/regencies/${provId}.json`);
                const data = await res.json();
                resetSelect(kota, "Pilih Kota");
                data.forEach(k => kota.innerHTML +=
                    `<option value="${k.name}" data-id="${k.id}">${k.name}</option>`);
                resetSelect(kecamatan, "Pilih Kecamatan");
                resetSelect(kelurahan, "Pilih Kelurahan");
            }

            async function loadKecamatanAPI() {
                const kotaId = kota.options[kota.selectedIndex]?.dataset.id;
                if (!kotaId) return;
                loading(kecamatan);
                resetSelect(kelurahan, "Pilih Kelurahan");
                const res = await fetch(`${API}/districts/${kotaId}.json`);
                const data = await res.json();
                resetSelect(kecamatan, "Pilih Kecamatan");
                data.forEach(kec => kecamatan.innerHTML +=
                    `<option value="${kec.name}" data-id="${kec.id}">${kec.name}</option>`);
            }

            async function loadKelurahanAPI() {
                const kecId = kecamatan.options[kecamatan.selectedIndex]?.dataset.id;
                if (!kecId) return;
                loading(kelurahan);
                const res = await fetch(`${API}/villages/${kecId}.json`);
                const data = await res.json();
                resetSelect(kelurahan, "Pilih Kelurahan");
                data.forEach(kel => kelurahan.innerHTML += `<option value="${kel.name}">${kel.name}</option>`);
            }

            /* =========================
               EVENT LISTENERS
            ========================= */
            provinsi.addEventListener("focus", () => loadProvinsiAPI());
            provinsi.addEventListener("change", loadKotaAPI);
            kota.addEventListener("change", loadKecamatanAPI);
            kecamatan.addEventListener("change", loadKelurahanAPI);

            /* =========================
               MAP PICKER
            ========================= */
            const mapElement = document.getElementById("map");
            if (mapElement) {
                const defaultLat = parseFloat(latInput.value) || -6.0023;
                const defaultLng = parseFloat(lngInput.value) || 106.0112;
                const map = L.map("map").setView([defaultLat, defaultLng], 13);

                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    maxZoom: 19
                }).addTo(map);

                let marker = null;
                if (latInput.value && lngInput.value) {
                    marker = L.marker([latInput.value, lngInput.value]).addTo(map);
                }

                map.on("click", async function(e) {
                    const lat = e.latlng.lat.toFixed(8);
                    const lng = e.latlng.lng.toFixed(8);

                    if (marker) marker.setLatLng(e.latlng);
                    else marker = L.marker(e.latlng).addTo(map);

                    latInput.value = lat;
                    lngInput.value = lng;

                    try {
                        const url =
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;
                        const res = await fetch(url, {
                            headers: {
                                "Accept": "application/json"
                            }
                        });
                        const data = await res.json();
                        if (data && data.display_name && alamatTextarea) alamatTextarea.value = data
                            .display_name;
                    } catch (err) {
                        console.error("Gagal ambil alamat", err);
                    }
                });
            }

        });
    </script>
@endpush
