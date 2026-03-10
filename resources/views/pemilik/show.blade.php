@extends('layouts.pemilik')

@section('content_pemilik')
    <section class="identity-detail-section">
        <div class="container">

            @if (session('success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="identity-page-header">
                <div>
                    <h1>Detail Identitas Pemilik Kos</h1>
                    <p>Lihat data identitas yang telah Anda kirim dan pantau status verifikasinya.</p>
                </div>
            </div>

            @php
                $status = $identitas->verification_status ?? 'pending';
            @endphp

            <div
                class="verification-info
                {{ $status === 'approved' ? 'approved' : '' }}
                {{ $status === 'rejected' ? 'rejected' : '' }}">
                <div class="verification-info-icon">
                    @if ($status === 'approved')
                        <i class="fa-solid fa-badge-check"></i>
                    @elseif($status === 'rejected')
                        <i class="fa-solid fa-circle-xmark"></i>
                    @else
                        <i class="fa-solid fa-clock"></i>
                    @endif
                </div>

                <div class="verification-info-text">
                    @if ($status === 'approved')
                        <h3>Status identitas Anda sudah approved</h3>
                        <p>Semua fitur pengelolaan kos sudah dapat Anda akses.</p>
                    @elseif($status === 'rejected')
                        <h3>Status identitas Anda ditolak</h3>
                        <p>Silakan tunggu arahan admin. Saat ini data identitas Anda belum dapat digunakan untuk mengakses
                            fitur pemilik kos.</p>
                    @else
                        <h3>Status identitas Anda masih menunggu verifikasi</h3>
                        <p>
                            Data Anda sedang ditinjau admin. Tunggu hingga status menjadi <strong>approved</strong>
                            agar semua fitur seperti kelola kos, booking, dan pembayaran dapat diakses.
                        </p>
                    @endif
                </div>
            </div>

            <div class="identity-detail-grid">
                <div class="identity-profile-card">
                    <div class="profile-avatar-wrap">
                        @if ($identitas->avatar)
                            <img src="{{ asset('storage/' . $identitas->avatar) }}" alt="Avatar" class="profile-avatar">
                        @else
                            <div class="profile-avatar profile-avatar-fallback">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </div>

                    <div class="profile-main-info">
                        <h2>{{ $identitas->nama_lengkap }}</h2>
                        <p>{{ $identitas->nama_usaha ?? '-' }}</p>

                        <div class="status-badge-group">
                            <span
                                class="status-badge
                                {{ $status === 'approved' ? 'approved' : '' }}
                                {{ $status === 'rejected' ? 'rejected' : '' }}">

                                @if ($status === 'approved')
                                    <i class="fa-solid fa-circle-check"></i>
                                    Approved
                                @elseif($status === 'rejected')
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Rejected
                                @else
                                    <i class="fa-solid fa-hourglass-half"></i>
                                    Pending
                                @endif
                            </span>

                            <span class="status-chip">
                                {{ ucfirst($identitas->status_pengelola) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="identity-data-card">
                    <div class="card-title">
                        <h3>Informasi Pribadi</h3>
                    </div>

                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Nama Lengkap</span>
                            <strong>{{ $identitas->nama_lengkap }}</strong>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">NIK</span>
                            <strong>{{ $identitas->nik }}</strong>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Jenis Kelamin</span>
                            <strong>{{ ucfirst($identitas->jenis_kelamin) }}</strong>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Status Pengelola</span>
                            <strong>{{ ucfirst($identitas->status_pengelola) }}</strong>
                        </div>
                    </div>
                </div>

                <div class="identity-data-card">
                    <div class="card-title">
                        <h3>Informasi Usaha</h3>
                    </div>

                    <div class="detail-list">
                        <div class="detail-item detail-item-full">
                            <span class="detail-label">Nama Usaha</span>
                            <strong>{{ $identitas->nama_usaha }}</strong>
                        </div>
                    </div>
                </div>

                <div class="identity-data-card">
                    <div class="card-title">
                        <h3>Informasi Kontak</h3>
                    </div>

                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Nomor WhatsApp</span>
                            <strong>{{ $identitas->no_wa }}</strong>
                        </div>

                        <div class="detail-item detail-item-full">
                            <span class="detail-label">Alamat Lengkap</span>
                            <strong>{{ $identitas->alamat }}</strong>
                        </div>
                    </div>
                </div>

                <div class="identity-data-card">
                    <div class="card-title">
                        <h3>Status Verifikasi</h3>
                    </div>

                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <strong>
                                @if ($status === 'approved')
                                    Approved
                                @elseif($status === 'rejected')
                                    Rejected
                                @else
                                    Pending
                                @endif
                            </strong>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Tanggal Verifikasi</span>
                            <strong>
                                {{ $identitas->verified_at ? \Carbon\Carbon::parse($identitas->verified_at)->format('d M Y H:i') : '-' }}
                            </strong>
                        </div>

                        <div class="detail-item detail-item-full">
                            <span class="detail-label">Catatan Admin</span>
                            <strong>{{ $identitas->verification_note ?: 'Belum ada catatan dari admin.' }}</strong>
                        </div>
                    </div>
                </div>

                <div class="identity-data-card">
                    <div class="card-title">
                        <h3>Dokumen Verifikasi</h3>
                    </div>

                    <div class="document-grid">
                        <div class="document-item">
                            <span class="detail-label">Foto KTP</span>
                            <div class="document-preview">
                                <img src="{{ asset('storage/' . $identitas->foto_ktp) }}" alt="Foto KTP">
                            </div>
                        </div>

                        <div class="document-item">
                            <span class="detail-label">Foto Selfie dengan KTP</span>
                            <div class="document-preview">
                                <img src="{{ asset('storage/' . $identitas->foto_selfie) }}" alt="Foto Selfie KTP">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .identity-detail-section {
            padding: 32px 0 60px;
            background: #f8fafc;
            min-height: 100vh;
        }

        .identity-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .identity-page-header h1 {
            margin: 0 0 6px;
            font-size: 28px;
            color: #0f172a;
        }

        .identity-page-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .alert-success,
        .alert-error {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .verification-info {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 18px 20px;
            border-radius: 18px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            margin-bottom: 24px;
        }

        .verification-info.approved {
            background: #ecfdf5;
            border-color: #a7f3d0;
        }

        .verification-info.rejected {
            background: #fef2f2;
            border-color: #fecaca;
        }

        .verification-info-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.7);
            color: #ea580c;
            font-size: 20px;
            flex-shrink: 0;
        }

        .verification-info.approved .verification-info-icon {
            color: #059669;
        }

        .verification-info.rejected .verification-info-icon {
            color: #dc2626;
        }

        .verification-info-text h3 {
            margin: 0 0 6px;
            font-size: 18px;
            color: #0f172a;
        }

        .verification-info-text p {
            margin: 0;
            color: #475569;
            line-height: 1.7;
            font-size: 14px;
        }

        .identity-detail-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
        }

        .identity-profile-card,
        .identity-data-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        }

        .identity-profile-card {
            grid-column: span 12;
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 24px;
            flex-wrap: wrap;
        }

        .profile-avatar-wrap {
            flex-shrink: 0;
        }

        .profile-avatar {
            width: 104px;
            height: 104px;
            object-fit: cover;
            border-radius: 22px;
            border: 1px solid #e2e8f0;
        }

        .profile-avatar-fallback {
            background: #ecfeff;
            color: #0f766e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
        }

        .profile-main-info h2 {
            margin: 0 0 8px;
            font-size: 24px;
            color: #0f172a;
        }

        .profile-main-info p {
            margin: 0 0 14px;
            color: #64748b;
            font-size: 14px;
        }

        .status-badge-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .status-badge,
        .status-chip {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .status-badge {
            background: #fef3c7;
            color: #b45309;
        }

        .status-badge.approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.rejected {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-chip {
            background: #e2e8f0;
            color: #334155;
        }

        .identity-data-card {
            grid-column: span 6;
            padding: 22px;
        }

        .card-title {
            margin-bottom: 18px;
        }

        .card-title h3 {
            margin: 0;
            font-size: 18px;
            color: #0f172a;
        }

        .detail-list {
            display: grid;
            gap: 14px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 14px 16px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .detail-item-full {
            grid-column: 1 / -1;
        }

        .detail-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .detail-item strong {
            font-size: 15px;
            color: #0f172a;
            line-height: 1.6;
            font-weight: 600;
        }

        .document-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .document-item {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .document-preview {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .document-preview img {
            width: 100%;
            max-height: 320px;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 992px) {
            .identity-data-card {
                grid-column: span 12;
            }
        }

        @media (max-width: 640px) {
            .identity-detail-section {
                padding: 24px 0 50px;
            }

            .identity-profile-card {
                padding: 20px;
            }

            .profile-avatar {
                width: 88px;
                height: 88px;
                border-radius: 18px;
            }

            .identity-page-header h1 {
                font-size: 22px;
            }
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
    </style>
@endpush
