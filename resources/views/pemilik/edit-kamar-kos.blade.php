@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="mhs-content">

        {{-- tombol kembali --}}
        <a href="{{ route('pemilik.kos.detail', $kos->slug) }}" class="btn-back-kamar">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        <div class="dashboard-modern">

            {{-- CARD INFO KOS --}}
            <div class="content-card kos-info-card">

                <div class="kos-info-wrap">

                    <img src="{{ $kos->cover && Storage::disk('public')->exists($kos->cover)
                        ? asset('storage/' . $kos->cover)
                        : asset('image/default.png') }}"
                        class="kos-info-img">

                    <div class="kos-info-text">

                        <h2>{{ $kos->nama_kos }}</h2>

                        <p class="kos-info-location">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $kos->alamat }}, {{ $kos->kecamatan }}, {{ $kos->kota }}
                        </p>

                        <span class="tag">
                            {{ ucfirst($kos->tipe_kos) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- FORM EDIT KAMAR --}}
            <div class="content-card">

                <div class="card-head">
                    <div>
                        <h2>Edit Kamar</h2>
                        <p>Perbarui data kamar kos</p>
                    </div>
                </div>

                <form action="{{ route('pemilik.kamar.update', [$kos->slug, $kamar->kode_kamar]) }}" method="POST"
                    onsubmit="return handleSubmitKamar()">

                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        {{-- NAMA KAMAR --}}
                        <div class="form-group">
                            <label>Nama Kamar <span class="required">*</span></label>

                            <input type="text" name="nama_kamar" value="{{ old('nama_kamar', $kamar->nama_kamar) }}"
                                class="form-control @error('nama_kamar') is-invalid @enderror" required>

                            @error('nama_kamar')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- KODE KAMAR --}}
                        <input type="text" class="form-control" value="{{ $kamar->kode_kamar }}" readonly>


                        {{-- HARGA --}}
                        <div class="form-group">
                            <label>Harga / Bulan <span class="required">*</span></label>

                            <input type="number" name="harga" value="{{ old('harga', $kamar->harga) }}"
                                class="form-control @error('harga') is-invalid @enderror" required>

                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- DEPOSIT --}}
                        <div class="form-group">
                            <label>Deposit</label>

                            <input type="number" name="deposit" value="{{ old('deposit', $kamar->deposit) }}"
                                class="form-control @error('deposit') is-invalid @enderror">

                            @error('deposit')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- LUAS --}}
                        <div class="form-group">
                            <label>Luas Kamar (m²)</label>

                            <input type="number" name="luas" value="{{ old('luas', $kamar->luas) }}"
                                class="form-control @error('luas') is-invalid @enderror">

                            @error('luas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- STOK --}}
                        <div class="form-group">
                            <label>Jumlah Stok <span class="required">*</span></label>

                            <input type="number" name="stok" value="{{ old('stok', $kamar->stok) }}"
                                class="form-control @error('stok') is-invalid @enderror" required>

                            @error('stok')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        {{-- STATUS --}}
                        <div class="form-group">
                            <label>Status</label>

                            <select name="tersedia" class="form-control">

                                <option value="1" {{ old('tersedia', $kamar->tersedia) == 1 ? 'selected' : '' }}>
                                    Tersedia
                                </option>

                                <option value="0" {{ old('tersedia', $kamar->tersedia) == 0 ? 'selected' : '' }}>
                                    Tidak Tersedia
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- DESKRIPSI --}}
                    <div class="form-group mt-3">

                        <label>Deskripsi</label>

                        <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="form-action">

                        <button type="submit" class="btn-save-kamar" id="btnSaveKamar">

                            <span class="btn-icon">
                                <i class="fa-solid fa-pen"></i>
                            </span>

                            <span class="btn-text">
                                Update Kamar
                            </span>

                            <span class="btn-loading">
                                <i class="fa-solid fa-spinner fa-spin"></i>
                                Menyimpan...
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
@endsection
@push('styles')
    <style>
        /* required label */
        .required {
            color: #dc2626;
            margin-left: 4px;
            font-weight: 600;
        }

        /* error message */
        .text-danger {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        /* invalid input */
        .is-invalid {
            border-color: #dc2626;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.15);
        }

        /* placeholder */
        .form-control::placeholder {
            color: #9ca3af;
            font-size: 13px;
        }

        /* kos info */
        .kos-info-wrap {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .kos-info-img {
            width: 120px;
            height: 90px;
            border-radius: 14px;
            object-fit: cover;
        }

        .kos-info-text h2 {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .kos-info-location {
            font-size: 14px;
            margin-bottom: 7px;
            color: #6b7280;
            display: flex;
            gap: 6px;
            align-items: center;
        }

        /* form */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-group {
            margin-bottom: 6px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 11px 12px;
            font-size: 14px;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px var(--primary-soft);
        }

        .form-action {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        /* mobile */
        @media(max-width:768px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .kos-info-wrap {
                flex-direction: column;
                align-items: flex-start;
            }

            .kos-info-img {
                width: 100%;
                height: 160px;
            }

        }

        /* tombol simpan kamar */
        .btn-save-kamar {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            border: none;
            border-radius: 14px;
            background: var(--primary);
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .btn-save-kamar:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .btn-save-kamar:active {
            transform: scale(.98);
        }

        .btn-icon {
            font-size: 14px;
        }

        .btn-loading {
            display: none;
        }

        .btn-save-kamar.loading .btn-text {
            display: none;
        }

        .btn-save-kamar.loading .btn-loading {
            display: inline-block;
        }

        .btn-loading {
            display: none;
        }

        .btn-save-kamar.loading .btn-text,
        .btn-save-kamar.loading .btn-icon {
            display: none;
        }

        .btn-save-kamar.loading .btn-loading {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* back  */
        .btn-back-kamar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 14px;
            background: #f3f4f6;
            color: #374151;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            margin-bottom: 10px;
        }

        .btn-back-kamar:hover {
            background: #e5e7eb;
        }

        .btn-add-kamar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 14px;
            background: #10b981;
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-add-kamar:hover {
            background: #059669;
        }
    </style>
@endpush
@push('script')
    <script>
        function handleSubmitKamar() {

            const btn = document.getElementById("btnSaveKamar");

            if (btn) {

                // ubah tampilan
                btn.classList.add("loading");

                const text = btn.querySelector(".btn-text");
                if (text) {
                    text.textContent = "Menyimpan...";
                }

                // disable tombol
                btn.disabled = true;

                // cegah klik ulang
                btn.style.pointerEvents = "none";

                // ubah type supaya tidak bisa submit ulang
                btn.type = "button";
            }

            return true; // tetap kirim form
        }
    </script>
@endpush
