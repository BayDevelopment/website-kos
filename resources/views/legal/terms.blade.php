@extends('layouts.auth')

@section('content')
    <section class="legal-section">
        <div class="container legal-container">

            <div class="legal-header">
                <h1>Syarat & Ketentuan</h1>
                <p>Terakhir diperbarui: {{ date('d M Y') }}</p>
            </div>

            <div class="legal-content">

                <h2>1. Pendahuluan</h2>
                <p>
                    Selamat datang di <b>RoomKos</b>. RoomKos merupakan platform digital yang
                    membantu mahasiswa menemukan dan menghubungi pemilik kos di wilayah
                    Cilegon dan Serang. Dengan menggunakan layanan RoomKos, pengguna
                    dianggap telah membaca, memahami, dan menyetujui seluruh syarat
                    dan ketentuan yang berlaku.
                </p>

                <h2>2. Persyaratan Pengguna</h2>
                <p>Untuk menjaga keamanan dan kenyamanan bersama, pengguna harus memenuhi ketentuan berikut:</p>

                <ul>
                    <li>Pengguna merupakan <b>mahasiswa aktif</b> atau individu yang membutuhkan tempat tinggal sementara
                        untuk tujuan yang sah.</li>
                    <li>Pengguna wajib memiliki <b>identitas resmi</b> seperti KTP atau dokumen identitas lain yang sah.
                    </li>
                    <li>Pengguna harus berusia <b>minimal 18 tahun</b> atau telah memenuhi usia yang diperbolehkan secara
                        hukum.</li>
                    <li>Pengguna wajib menggunakan platform RoomKos secara bertanggung jawab.</li>
                </ul>

                <h2>3. Verifikasi Identitas</h2>
                <p>
                    Dalam beberapa kondisi, RoomKos dapat meminta pengguna untuk melakukan
                    verifikasi identitas seperti KTP, kartu mahasiswa, atau dokumen lain
                    yang diperlukan guna menjaga keamanan platform dan mencegah
                    penyalahgunaan layanan.
                </p>

                <h2>4. Larangan Penggunaan</h2>
                <p>Pengguna dilarang menggunakan platform RoomKos untuk:</p>

                <ul>
                    <li>Kegiatan yang melanggar hukum.</li>
                    <li>Penyalahgunaan tempat tinggal atau kos.</li>
                    <li>Penipuan atau penyampaian informasi palsu.</li>
                    <li>Kegiatan yang mengganggu keamanan dan ketertiban lingkungan kos.</li>
                </ul>

                <h2>5. Tanggung Jawab Platform</h2>
                <p>
                    RoomKos berfungsi sebagai platform yang mempertemukan pencari kos
                    dan pemilik kos. Informasi kos yang ditampilkan merupakan data yang
                    disediakan oleh pemilik kos.
                </p>

                <p>
                    RoomKos tidak bertanggung jawab atas transaksi langsung antara
                    pengguna dan pemilik kos yang terjadi di luar platform.
                </p>

                <h2>6. Penangguhan Akun</h2>
                <p>
                    RoomKos berhak untuk menangguhkan atau menonaktifkan akun pengguna
                    yang terbukti melanggar syarat dan ketentuan yang berlaku.
                </p>

                <h2>7. Perubahan Ketentuan</h2>
                <p>
                    RoomKos dapat memperbarui atau mengubah syarat dan ketentuan ini
                    sewaktu-waktu tanpa pemberitahuan sebelumnya. Pengguna disarankan
                    untuk secara berkala meninjau halaman ini.
                </p>

                <h2>8. Kontak</h2>
                <p>
                    Jika Anda memiliki pertanyaan terkait syarat dan ketentuan ini,
                    silakan hubungi kami melalui halaman kontak atau email resmi
                    RoomKos.
                </p>

            </div>
            <div class="legal-actions">
                <a href="{{ url()->previous() }}" class="btn btn-ghost">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>

                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fa-solid fa-house"></i>
                    Beranda
                </a>
            </div>
        </div>
    </section>
@endsection


@push('styles')
    <style>
        .legal-section {
            padding: 80px 0;
        }

        .legal-container {
            max-width: 900px;
        }

        .legal-header {
            margin-bottom: 30px;
        }

        .legal-header h1 {
            font-size: 32px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .legal-header p {
            color: #64748b;
            font-size: 14px;
        }

        .legal-content {
            line-height: 1.8;
            color: #334155;
            font-size: 15px;
        }

        .legal-content h2 {
            margin-top: 28px;
            margin-bottom: 10px;
            font-size: 20px;
            color: #0f172a;
        }

        .legal-content ul {
            margin-left: 18px;
            margin-top: 10px;
        }

        .legal-content li {
            margin-bottom: 6px;
        }

        @media(max-width:640px) {

            .legal-section {
                padding: 60px 0;
            }

            .legal-header h1 {
                font-size: 26px;
            }

        }

        .legal-actions {
            margin-top: 40px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-ghost {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #0f172a;
        }

        .btn-ghost:hover {
            background: #f8fafc;
        }

        .legal-section {
            background: #fff;
            /* penting */
            padding: 50px 0;
        }
    </style>
@endpush
