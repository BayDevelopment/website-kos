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
                <form action="{{ route('mahasiswa.profile.identitas.update') }}" method="POST" enctype="multipart/form-data"
                    class="identity-form">
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
                                    value="{{ old('nama_lengkap', $identitas->nama_lengkap ?? '') }}"
                                    placeholder="Masukkan nama lengkap">
                                @error('nama_lengkap')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik"
                                    value="{{ old('nik', $identitas->nik ?? '') }}" placeholder="Masukkan NIK">
                                @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                                @error('jenis_kelamin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="asal_kota">Asal Kota</label>
                                <select id="asal_kota" name="asal_kota">
                                    <option value="">Pilih asal kota</option>
                                    <option value="Kota Cilegon"
                                        {{ old('asal_kota', $identitas->asal_kota ?? '') == 'Kota Cilegon' ? 'selected' : '' }}>
                                        Kota Cilegon
                                    </option>
                                    <option value="Kota Serang"
                                        {{ old('asal_kota', $identitas->asal_kota ?? '') == 'Kota Serang' ? 'selected' : '' }}>
                                        Kota Serang
                                    </option>
                                </select>
                                @error('asal_kota')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group form-group-full">
                                <label for="avatar">Foto Profil</label>

                                <input type="file" id="avatar" name="avatar" accept=".jpg,.jpeg"
                                    class="file-input-hidden">

                                <label for="avatar" class="upload-box">
                                    <div class="upload-box-left">
                                        <div class="upload-icon">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        <div class="upload-text">
                                            <strong id="file-name">
                                                {{ !empty($identitas?->avatar) ? 'Ganti foto profil' : 'Pilih foto profil' }}
                                            </strong>
                                            <span>Klik untuk upload foto</span>
                                        </div>
                                    </div>
                                    <div class="upload-action">
                                        Pilih File
                                    </div>
                                </label>

                                <small class="upload-hint">
                                    Foto harus berformat JPG/JPEG dan maksimal 1 MB.
                                </small>

                                @error('avatar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if (!empty($identitas?->avatar))
                                    <div class="avatar-preview-wrap">
                                        <img src="{{ asset('storage/' . $identitas->avatar) }}" alt="Avatar"
                                            class="avatar-preview">
                                    </div>
                                @endif
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
                                <label for="universitas_id">Asal Universitas</label>

                                <select id="universitas_id" name="universitas_id"
                                    {{ $universitas->isEmpty() ? 'disabled' : '' }}>

                                    @if ($universitas->isEmpty())
                                        <option value="">
                                            Belum ada data universitas
                                        </option>
                                    @else
                                        <option value="">Pilih universitas</option>

                                        @foreach ($universitas as $u)
                                            <option value="{{ $u->id }}"
                                                {{ old('universitas_id', $identitas->universitas_id ?? '') == $u->id ? 'selected' : '' }}>
                                                {{ $u->nama_universitas }} - {{ $u->kota }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>

                                @error('universitas_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if ($universitas->isEmpty())
                                    <small class="text-muted">
                                        Data universitas belum tersedia. Silakan hubungi admin.
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select id="semester" name="semester">
                                    <option value="">Pilih semester</option>
                                    @for ($i = 1; $i <= 14; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('semester', $identitas->semester ?? '') == $i ? 'selected' : '' }}>
                                            Semester {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                                @error('no_wa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group form-group-full">
                                <label for="alamat">Alamat Lengkap</label>
                                <textarea id="alamat" name="alamat" rows="5" placeholder="Masukkan alamat lengkap">{{ old('alamat', $identitas->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if ($identitas)
                        <div class="form-section">
                            <div class="section-title">
                                <h2>Status Verifikasi</h2>
                                <p>Status ini diisi oleh sistem / admin.</p>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Status Verifikasi</label>
                                    <input type="text" value="{{ ucfirst($identitas->verification_status) }}"
                                        disabled>
                                </div>

                                @if ($identitas->verification_note)
                                    <div class="form-group form-group-full">
                                        <label>Catatan Verifikasi</label>
                                        <textarea rows="4" disabled>{{ $identitas->verification_note }}</textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

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

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const fileName = document.getElementById('file-name');

            if (avatarInput && fileName) {
                avatarInput.addEventListener('change', function() {
                    if (this.files && this.files.length > 0) {
                        fileName.textContent = this.files[0].name;
                    } else {
                        fileName.textContent = 'Pilih foto profil';
                    }
                });
            }
        });
    </script>
@endpush
