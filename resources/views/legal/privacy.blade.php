@extends('layouts.auth')

@section('content')
    <section class="legal-section">
        <div class="container legal-container">

            <div class="legal-header">
                <h1>Kebijakan Privasi</h1>
                <p>Terakhir diperbarui: {{ date('d M Y') }}</p>
            </div>

            <div class="legal-content">

                <h2>1. Pendahuluan</h2>
                <p>
                    RoomKos menghargai privasi pengguna dan berkomitmen untuk melindungi
                    informasi pribadi yang diberikan oleh pengguna. Kebijakan privasi ini
                    menjelaskan bagaimana RoomKos mengumpulkan, menggunakan, dan melindungi
                    informasi pengguna saat menggunakan layanan platform RoomKos.
                </p>

                <h2>2. Informasi yang Kami Kumpulkan</h2>
                <p>Kami dapat mengumpulkan beberapa informasi berikut:</p>

                <ul>
                    <li>Nama lengkap pengguna.</li>
                    <li>Alamat email.</li>
                    <li>Informasi akun yang dibuat pada platform.</li>
                    <li>Riwayat pencarian kos dan aktivitas penggunaan.</li>
                    <li>Informasi perangkat dan browser yang digunakan untuk mengakses layanan.</li>
                </ul>

                <h2>3. Penggunaan Informasi</h2>
                <p>Informasi yang dikumpulkan digunakan untuk:</p>

                <ul>
                    <li>Menyediakan layanan pencarian kos yang lebih relevan.</li>
                    <li>Mengelola akun pengguna.</li>
                    <li>Meningkatkan kualitas layanan RoomKos.</li>
                    <li>Mencegah penyalahgunaan platform.</li>
                    <li>Berkomunikasi dengan pengguna terkait layanan.</li>
                </ul>

                <h2>4. Keamanan Data</h2>
                <p>
                    RoomKos menerapkan langkah-langkah keamanan yang wajar untuk melindungi
                    informasi pengguna dari akses yang tidak sah, perubahan, pengungkapan,
                    atau penghancuran data.
                </p>

                <p>
                    Informasi sensitif seperti password disimpan menggunakan metode
                    enkripsi yang aman sesuai dengan standar keamanan aplikasi modern.
                </p>

                <h2>5. Pembagian Informasi</h2>
                <p>
                    RoomKos tidak menjual atau menyewakan informasi pribadi pengguna kepada
                    pihak ketiga. Informasi pengguna hanya dapat dibagikan jika diperlukan
                    untuk:
                </p>

                <ul>
                    <li>Mematuhi kewajiban hukum.</li>
                    <li>Melindungi hak dan keamanan platform.</li>
                    <li>Mencegah aktivitas ilegal atau penipuan.</li>
                </ul>

                <h2>6. Cookie dan Teknologi Pelacakan</h2>
                <p>
                    RoomKos dapat menggunakan cookie atau teknologi serupa untuk meningkatkan
                    pengalaman pengguna, seperti mengingat preferensi pengguna atau
                    menganalisis penggunaan layanan.
                </p>

                <h2>7. Hak Pengguna</h2>
                <p>Pengguna memiliki hak untuk:</p>

                <ul>
                    <li>Mengakses informasi pribadi yang tersimpan di akun.</li>
                    <li>Memperbarui atau mengoreksi data pribadi.</li>
                    <li>Menghapus akun sesuai dengan kebijakan yang berlaku.</li>
                </ul>

                <h2>8. Perubahan Kebijakan Privasi</h2>
                <p>
                    RoomKos dapat memperbarui kebijakan privasi ini dari waktu ke waktu.
                    Perubahan akan diumumkan melalui halaman ini.
                </p>

                <h2>9. Kontak</h2>
                <p>
                    Jika Anda memiliki pertanyaan terkait kebijakan privasi ini,
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
            background: #fff;
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

        @media(max-width:640px) {

            .legal-section {
                padding: 60px 0;
            }

            .legal-header h1 {
                font-size: 26px;
            }

        }
    </style>
@endpush
