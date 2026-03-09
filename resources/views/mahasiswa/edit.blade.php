@extends('layouts.mahasiswa')

@section('content_mahasiswa')
    <div class="identity-page">
        <div class="identity-wrapper">
            <div class="identity-header">
                <div>
                    <span class="identity-badge">Profile Mahasiswa</span>
                    <h1>Lengkapi Identitas Diri</h1>
                    <p>
                        Silakan lengkapi data diri Anda dengan benar. Data ini akan digunakan
                        untuk proses verifikasi akun mahasiswa sebelum dapat menggunakan semua fitur RoomKos.
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="identity-alert success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="identity-alert error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        <strong>Terdapat kesalahan pada form:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="identity-card">
                <form action="{{ route('mahasiswa.profile.identitas.update') }}" method="POST" class="identity-form">
                    @csrf

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Informasi Pribadi</h2>
                            <p>Isi data identitas utama mahasiswa.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $identitas->nama_lengkap ?? (auth()->user()->name ?? '')) }}"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik"
                                    value="{{ old('nik', $identitas->nik ?? '') }}" placeholder="Masukkan NIK">
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="laki-laki"
                                        {{ old('jenis_kelamin', $identitas->jenis_kelamin ?? '') == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="perempuan"
                                        {{ old('jenis_kelamin', $identitas->jenis_kelamin ?? '') == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="asal_kota">Asal Kota</label>
                                <input type="text" id="asal_kota" name="asal_kota"
                                    value="{{ old('asal_kota', $identitas->asal_kota ?? '') }}"
                                    placeholder="Contoh: Cilegon">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Informasi Akademik</h2>
                            <p>Data kampus dan semester aktif Anda.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="asal_universitas">Asal Universitas</label>
                                <input type="text" id="asal_universitas" name="asal_universitas"
                                    value="{{ old('asal_universitas', $identitas->asal_universitas ?? '') }}"
                                    placeholder="Masukkan nama universitas">
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="number" id="semester" name="semester" min="1" max="14"
                                    value="{{ old('semester', $identitas->semester ?? '') }}" placeholder="Contoh: 4">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Informasi Kontak</h2>
                            <p>Pastikan nomor WhatsApp aktif dan alamat sesuai.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="no_wa">Nomor WhatsApp</label>
                                <input type="text" id="no_wa" name="no_wa"
                                    value="{{ old('no_wa', $identitas->no_wa ?? '') }}" placeholder="08xxxxxxxxxx">
                            </div>

                            <div class="form-group form-group-full">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea id="alamat" name="alamat" rows="5" placeholder="Masukkan alamat lengkap">{{ old('alamat', $identitas->alamat ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="identity-note">
                        <i class="fa-solid fa-shield-halved"></i>
                        <p>
                            Pastikan semua data yang Anda isi benar. Data akan ditinjau untuk proses verifikasi akun.
                            Jika data tidak valid, akun Anda dapat ditolak untuk menggunakan fitur transaksi dan booking.
                        </p>
                    </div>

                    <div class="identity-actions">
                        <button type="submit" class="btn-save-identity">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Identitas
                        </button>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-logout-identity">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* =========================
       IDENTITAS MAHASISWA PAGE
    ========================= */
        .identity-page {
            padding: 6px 0 4px;
        }

        .identity-wrapper {
            max-width: 980px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .identity-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .identity-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .identity-header h1 {
            font-size: 31px;
            line-height: 1.2;
            color: #111827;
            margin-bottom: 10px;
        }

        .identity-header p {
            max-width: 760px;
            color: #6b7280;
            line-height: 1.8;
            font-size: 14px;
        }

        .identity-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 18px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.7;
        }

        .identity-alert.success {
            background: #ecfdf3;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .identity-alert.error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .identity-alert i {
            margin-top: 3px;
            flex-shrink: 0;
        }

        .identity-alert ul {
            margin-top: 8px;
            padding-left: 18px;
        }

        .identity-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .identity-form {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 18px;
            padding-bottom: 24px;
            border-bottom: 1px solid #eef2f7;
        }

        .form-section:last-of-type {
            border-bottom: none;
            padding-bottom: 0;
        }

        .section-title h2 {
            font-size: 19px;
            color: #111827;
            margin-bottom: 6px;
        }

        .section-title p {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group-full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #dbe3ee;
            background: #fbfdff;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 14px;
            font-family: inherit;
            color: #111827;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9ca3af;
        }

        .identity-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 18px;
            border-radius: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
        }

        .identity-note i {
            color: #2563eb;
            font-size: 18px;
            margin-top: 2px;
        }

        .identity-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            padding-top: 8px;
        }

        .btn-save-identity,
        .btn-logout-identity {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            border-radius: 16px;
            padding: 13px 18px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-save-identity {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.18);
        }

        .btn-save-identity:hover {
            transform: translateY(-1px);
            background: #1d4ed8;
        }

        .btn-logout-identity {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-logout-identity:hover {
            background: #e5e7eb;
        }

        /* TABLET */
        @media (max-width: 992px) {

            .identity-header,
            .identity-card {
                padding: 24px;
            }

            .identity-header h1 {
                font-size: 27px;
            }
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .identity-wrapper {
                max-width: 100%;
            }

            .identity-header,
            .identity-card {
                padding: 20px;
                border-radius: 22px;
            }

            .identity-header h1 {
                font-size: 23px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .identity-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-save-identity,
            .btn-logout-identity {
                width: 100%;
            }
        }
    </style>
@endpush
