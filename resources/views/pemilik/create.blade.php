@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="identity-page">
        <div class="identity-wrapper">
            <div class="identity-header">
                <div>
                    <span class="identity-badge">Profil Pemilik Kos</span>
                    <h1>Lengkapi Identitas Pemilik</h1>
                    <p>
                        Silakan lengkapi data identitas pemilik kos dengan benar. Data ini akan digunakan
                        untuk proses verifikasi akun pemilik sebelum dapat menggunakan seluruh fitur RoomKos.
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
                <form action="{{ route('pemilik.profile.identitas.store') }}" method="POST" enctype="multipart/form-data"
                    class="identity-form">
                    @csrf

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Informasi Pribadi</h2>
                            <p>Isi data identitas utama pemilik kos.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama_lengkap">
                                    Nama Lengkap <span class="required-star">*</span>
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    class="@error('nama_lengkap') is-invalid @enderror"
                                    value="{{ old('nama_lengkap', $identitas->nama_lengkap ?? '') }}"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('nama_lengkap')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nik">
                                    NIK <span class="required-star">*</span>
                                </label>
                                <input type="text" id="nik" name="nik"
                                    class="@error('nik') is-invalid @enderror"
                                    value="{{ old('nik', $identitas->nik ?? '') }}" placeholder="Masukkan NIK" required>
                                @error('nik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">
                                    Jenis Kelamin <span class="required-star">*</span>
                                </label>
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="@error('jenis_kelamin') is-invalid @enderror" required>
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
                                <label for="no_wa">
                                    Nomor WhatsApp <span class="required-star">*</span>
                                </label>
                                <input type="text" id="no_wa" name="no_wa"
                                    class="@error('no_wa') is-invalid @enderror"
                                    value="{{ old('no_wa', $identitas->no_wa ?? '') }}" placeholder="08xxxxxxxxxx"
                                    required>
                                @error('no_wa')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group form-group-full">
                                <label for="alamat">
                                    Alamat Lengkap <span class="required-star">*</span>
                                </label>
                                <textarea id="alamat" name="alamat" rows="5" class="@error('alamat') is-invalid @enderror"
                                    placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $identitas->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group form-group-full">
                                <label for="avatar">
                                    Foto Profil
                                </label>

                                <input type="file" id="avatar" name="avatar" accept=".jpg,.jpeg,.png"
                                    class="file-input-hidden @error('avatar') is-invalid @enderror">

                                <label for="avatar" class="upload-box">
                                    <div class="upload-box-left">
                                        <div class="upload-icon">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                        </div>
                                        <div class="upload-text">
                                            <strong id="avatar-file-name">
                                                {{ !empty($identitas?->avatar) ? 'Ganti foto profil' : 'Pilih foto profil' }}
                                            </strong>
                                            <span>Klik untuk upload foto profil</span>
                                        </div>
                                    </div>
                                    <div class="upload-action">
                                        Pilih File
                                    </div>
                                </label>

                                <small class="upload-hint">
                                    Opsional. Foto profil berformat JPG/JPEG/PNG dan maksimal 1 MB.
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
                            <h2>Informasi Usaha</h2>
                            <p>Data usaha kos dan status pengelolaan properti Anda.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama_usaha">
                                    Nama Usaha / Nama Kos <span class="required-star">*</span>
                                </label>
                                <input type="text" id="nama_usaha" name="nama_usaha"
                                    class="@error('nama_usaha') is-invalid @enderror"
                                    value="{{ old('nama_usaha', $identitas->nama_usaha ?? '') }}"
                                    placeholder="Contoh: Kos Melati Residence" required>
                                @error('nama_usaha')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status_pengelola">
                                    Status Pengelola <span class="required-star">*</span>
                                </label>
                                <select id="status_pengelola" name="status_pengelola"
                                    class="@error('status_pengelola') is-invalid @enderror" required>
                                    <option value="">Pilih status pengelola</option>
                                    <option value="pemilik"
                                        {{ old('status_pengelola', $identitas->status_pengelola ?? 'pemilik') == 'pemilik' ? 'selected' : '' }}>
                                        Pemilik
                                    </option>
                                    <option value="pengelola"
                                        {{ old('status_pengelola', $identitas->status_pengelola ?? '') == 'pengelola' ? 'selected' : '' }}>
                                        Pengelola
                                    </option>
                                    <option value="agen"
                                        {{ old('status_pengelola', $identitas->status_pengelola ?? '') == 'agen' ? 'selected' : '' }}>
                                        Agen
                                    </option>
                                </select>
                                @error('status_pengelola')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="section-title">
                            <h2>Dokumen Verifikasi</h2>
                            <p>Upload dokumen yang dibutuhkan untuk proses verifikasi akun pemilik.</p>
                        </div>

                        <div class="form-grid">
                            <div class="form-group form-group-full">
                                <label for="foto_ktp">
                                    Foto KTP <span class="required-star">*</span>
                                </label>

                                <input type="file" id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png"
                                    class="file-input-hidden @error('foto_ktp') is-invalid @enderror" required>

                                <label for="foto_ktp" class="upload-box">
                                    <div class="upload-box-left">
                                        <div class="upload-icon">
                                            <i class="fa-solid fa-id-card"></i>
                                        </div>
                                        <div class="upload-text">
                                            <strong id="ktp-file-name">
                                                {{ !empty($identitas?->foto_ktp) ? 'Ganti foto KTP' : 'Pilih foto KTP' }}
                                            </strong>
                                            <span>Upload foto KTP yang jelas dan terbaca</span>
                                        </div>
                                    </div>
                                    <div class="upload-action">
                                        Pilih File
                                    </div>
                                </label>

                                <small class="upload-hint">
                                    File JPG/JPEG/PNG, maksimal 1 MB.
                                </small>

                                @error('foto_ktp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                @if (!empty($identitas?->foto_ktp))
                                    <div class="avatar-preview-wrap">
                                        <img src="{{ asset('storage/' . $identitas->foto_ktp) }}" alt="Foto KTP"
                                            class="avatar-preview">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group form-group-full">
                                <label>
                                    Foto Selfie dengan KTP <span class="required-star">*</span>
                                </label>

                                <div class="camera-capture-card">
                                    <div class="camera-guide">
                                        <div class="camera-guide-badge">
                                            <i class="fa-solid fa-camera"></i>
                                            Verifikasi Wajah + KTP
                                        </div>
                                        <p>
                                            Posisikan wajah dan KTP Anda di dalam frame. Pastikan pencahayaan cukup,
                                            tulisan pada KTP terbaca, dan wajah terlihat jelas.
                                        </p>
                                    </div>

                                    <div class="camera-stage">
                                        <video id="selfieCamera" class="camera-video" autoplay playsinline muted></video>

                                        <div class="camera-overlay">
                                            <div class="face-frame">
                                                <span class="frame-label">Posisikan wajah di area ini</span>
                                            </div>

                                            <div class="ktp-frame">
                                                <span class="frame-label">Pegang KTP di area ini</span>
                                            </div>
                                        </div>

                                        <canvas id="selfieCanvas" class="camera-canvas" style="display: none;"></canvas>
                                    </div>

                                    <div class="camera-actions">
                                        <button type="button" class="btn-camera btn-camera-secondary"
                                            id="startSelfieCamera">
                                            <i class="fa-solid fa-video"></i>
                                            Buka Kamera
                                        </button>

                                        <button type="button" class="btn-camera btn-camera-primary"
                                            id="captureSelfiePhoto" disabled>
                                            <i class="fa-solid fa-camera"></i>
                                            Ambil Foto
                                        </button>

                                        <button type="button" class="btn-camera btn-camera-light" id="retakeSelfiePhoto"
                                            style="display: none;">
                                            <i class="fa-solid fa-rotate-right"></i>
                                            Ambil Ulang
                                        </button>
                                    </div>

                                    <input type="file" id="foto_selfie" name="foto_selfie"
                                        accept=".jpg,.jpeg,.png,image/*"
                                        class="file-input-hidden @error('foto_selfie') is-invalid @enderror" required>

                                    <small class="upload-hint">
                                        Kamera depan akan digunakan jika tersedia. Foto hasil capture akan otomatis dipasang
                                        ke form.
                                    </small>

                                    @error('foto_selfie')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="camera-preview-wrap" id="selfiePreviewWrap" style="display: none;">
                                        <p class="preview-title">Hasil Foto Selfie + KTP</p>
                                        <img id="selfiePreviewImage" src="" alt="Preview Selfie dengan KTP"
                                            class="camera-preview-image">
                                    </div>

                                    @if (!empty($identitas?->foto_selfie))
                                        <div class="camera-preview-wrap">
                                            <p class="preview-title">Foto yang sudah tersimpan</p>
                                            <img src="{{ asset('storage/' . $identitas->foto_selfie) }}">
                                        </div>
                                    @endif
                                </div>
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

                                <div class="form-group">
                                    <label>Status Kelengkapan</label>
                                    <input type="text"
                                        value="{{ $identitas->is_complete ? 'Lengkap' : 'Belum Lengkap' }}" disabled>
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
                            Pastikan semua data dan dokumen yang Anda isi benar. Setelah data dikirim,
                            akun pemilik akan masuk proses verifikasi admin. Selama belum disetujui,
                            Anda belum dapat menggunakan fitur pengelolaan kos, kamar, booking, maupun transaksi.
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
        .required-star {
            color: #dc3545;
            font-weight: 700;
            margin-left: 4px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

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
            background: linear-gradient(135deg, #ffffff 0%, #f7fffc 100%);
            border: 1px solid rgba(229, 231, 235, 0.9);
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .identity-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            background: #ecfeff;
            color: #0f766e;
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
            border-color: #0f766e;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.08);
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
            color: #0f766e;
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

        .btn-save-identity {
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
            background: #0f766e;
            color: #fff;
            box-shadow: 0 10px 20px rgba(15, 118, 110, 0.18);
        }

        .btn-save-identity:hover {
            transform: translateY(-1px);
            background: #0d655e;
        }

        @media (max-width: 992px) {

            .identity-header,
            .identity-card {
                padding: 24px;
            }

            .identity-header h1 {
                font-size: 27px;
            }
        }

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

            .btn-save-identity {
                width: 100%;
            }
        }

        /* camera capture card */
        .camera-capture-card {
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .camera-guide {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .camera-guide-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            padding: 8px 12px;
            border-radius: 999px;
            background: #ecfeff;
            color: #0f766e;
            font-size: 13px;
            font-weight: 700;
        }

        .camera-guide p {
            margin: 0;
            font-size: 14px;
            line-height: 1.7;
            color: #64748b;
        }

        .camera-stage {
            position: relative;
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
            border-radius: 24px;
            overflow: hidden;
            background: #0f172a;
            aspect-ratio: 3 / 4;
            min-height: 420px;
        }

        .camera-video,
        .camera-canvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .camera-overlay {
            pointer-events: none;
            position: absolute;
            inset: 0;
            padding: 20px;
        }


        .face-frame,
        .ktp-frame {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border: 2px dashed rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.05);
        }

        .face-frame {
            top: 8%;
            width: 58%;
            height: 38%;
        }

        .ktp-frame {
            bottom: 10%;
            width: 58%;
            height: 18%;
        }

        .frame-label {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -36px;
            white-space: nowrap;
            background: rgba(15, 23, 42, 0.88);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 10px;
            border-radius: 999px;
        }

        .camera-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-camera {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .btn-camera:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .btn-camera-primary {
            background: #0f766e;
            color: #fff;
            box-shadow: 0 10px 20px rgba(15, 118, 110, 0.18);
        }

        .btn-camera-primary:hover:not(:disabled) {
            background: #0d655e;
            transform: translateY(-1px);
        }

        .btn-camera-secondary {
            background: #0f172a;
            color: #fff;
        }

        .btn-camera-secondary:hover {
            background: #1e293b;
        }

        .btn-camera-light {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-camera-light:hover {
            background: #e2e8f0;
        }

        .camera-preview-wrap {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 4px;
        }

        .preview-title {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
        }

        .camera-preview-image {
            width: 100%;
            max-width: 360px;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }

        @media (max-width: 768px) {
            .camera-stage {
                min-height: 360px;
                border-radius: 18px;
            }

            .camera-overlay {
                padding: 16px;
            }

            .face-frame {
                width: 72%;
                height: 38%;
            }

            .ktp-frame {
                width: 68%;
                height: 20%;
                margin-right: 6%;
            }

            .frame-label {
                font-size: 11px;
                bottom: -32px;
            }

            .camera-actions {
                flex-direction: column;
            }

            .btn-camera {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .camera-stage {
                aspect-ratio: 3 / 4.4;
                min-height: 360px;
                border-radius: 18px;
            }

            .camera-overlay {
                padding: 14px;
            }

            .face-frame {
                top: 7%;
                width: 72%;
                height: 36%;
            }

            .ktp-frame {
                bottom: 9%;
                width: 72%;
                height: 17%;
            }

            .frame-label {
                font-size: 11px;
                bottom: -30px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .face-frame {
                width: 62%;
                height: 37%;
            }

            .ktp-frame {
                width: 62%;
                height: 18%;
            }
        }

        @media (min-width: 1025px) {
            .face-frame {
                width: 56%;
                height: 38%;
            }

            .ktp-frame {
                width: 54%;
                height: 18%;
            }
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bindFileName = (inputId, textId, defaultText) => {
                const input = document.getElementById(inputId);
                const text = document.getElementById(textId);

                if (input && text) {
                    input.addEventListener('change', function() {
                        if (this.files && this.files.length > 0) {
                            text.textContent = this.files[0].name;
                        } else {
                            text.textContent = defaultText;
                        }
                    });
                }
            };

            bindFileName('avatar', 'avatar-file-name', 'Pilih foto profil');
            bindFileName('foto_ktp', 'ktp-file-name', 'Pilih foto KTP');
            bindFileName('foto_selfie', 'selfie-file-name', 'Pilih foto selfie + KTP');

            const video = document.getElementById('selfieCamera');
            const canvas = document.getElementById('selfieCanvas');
            const startBtn = document.getElementById('startSelfieCamera');
            const captureBtn = document.getElementById('captureSelfiePhoto');
            const retakeBtn = document.getElementById('retakeSelfiePhoto');
            const previewWrap = document.getElementById('selfiePreviewWrap');
            const previewImage = document.getElementById('selfiePreviewImage');
            const fileInput = document.getElementById('foto_selfie');
            const fileNameText = document.getElementById('selfie-file-name');

            let stream = null;

            async function startCamera() {
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert('Browser ini tidak mendukung akses kamera.');
                    return;
                }

                try {
                    stopCamera();

                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: 'user',
                            width: {
                                ideal: 1080
                            },
                            height: {
                                ideal: 1350
                            }
                        },
                        audio: false
                    });

                    if (video) {
                        video.srcObject = stream;
                        video.style.display = 'block';
                    }

                    if (canvas) {
                        canvas.style.display = 'none';
                    }

                    if (captureBtn) {
                        captureBtn.disabled = false;
                    }

                    if (retakeBtn) {
                        retakeBtn.style.display = 'none';
                    }

                } catch (error) {
                    console.error(error);
                    alert(
                        'Kamera tidak dapat diakses. Pastikan izin kamera diberikan dan perangkat mendukung.'
                    );
                }
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
            }

            function dataURLtoFile(dataUrl, filename) {
                const arr = dataUrl.split(',');
                const mime = arr[0].match(/:(.*?);/)[1];
                const bstr = atob(arr[1]);
                let n = bstr.length;
                const u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }

                return new File([u8arr], filename, {
                    type: mime
                });
            }

            function setFileToInput(file, input) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }

            function capturePhoto() {
                if (!video || !canvas || !fileInput || !previewImage || !previewWrap) {
                    return;
                }

                if (!video.videoWidth || !video.videoHeight) {
                    alert('Kamera belum siap. Coba lagi sebentar.');
                    return;
                }

                const maxWidth = 1080;
                const scale = Math.min(1, maxWidth / video.videoWidth);
                const outputWidth = Math.round(video.videoWidth * scale);
                const outputHeight = Math.round(video.videoHeight * scale);

                canvas.width = outputWidth;
                canvas.height = outputHeight;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(video, 0, 0, outputWidth, outputHeight);

                const dataUrl = canvas.toDataURL('image/jpeg', 0.85);
                const file = dataURLtoFile(dataUrl, `selfie-ktp-${Date.now()}.jpg`);

                setFileToInput(file, fileInput);

                previewImage.src = dataUrl;
                previewWrap.style.display = 'flex';

                if (fileNameText) {
                    fileNameText.textContent = file.name;
                }

                video.style.display = 'none';
                canvas.style.display = 'none';

                if (retakeBtn) {
                    retakeBtn.style.display = 'inline-flex';
                }

                stopCamera();
            }

            startBtn?.addEventListener('click', startCamera);
            captureBtn?.addEventListener('click', capturePhoto);

            retakeBtn?.addEventListener('click', function() {
                if (previewImage) previewImage.src = '';
                if (previewWrap) previewWrap.style.display = 'none';
                if (fileInput) fileInput.value = '';
                if (fileNameText) fileNameText.textContent = 'Ambil foto selfie + KTP';
                startCamera();
            });

            window.addEventListener('beforeunload', stopCamera);

            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    stopCamera();
                }
            });
        });
    </script>
@endpush
