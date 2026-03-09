@extends('layouts.auth')

@section('content')
    <section class="auth-section">
        <div class="container">

            <div class="auth-wrapper">

                <div class="auth-card">

                    <div class="auth-header">
                        <img src="{{ asset('image/logo-nav.png') }}" class="auth-logo" alt="RoomKos">
                        <h2>Masuk ke RoomKos</h2>
                        <p>Cari kos terbaik di Cilegon & Serang</p>
                    </div>

                    <form method="POST" action="{{ route('mahasiswa.login.process') }}" class="auth-form">
                        @csrf

                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email" placeholder="email@email.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="password" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="auth-options">
                            <label>
                                <input type="checkbox" name="remember">
                                Ingat saya
                            </label>

                            <a href="#">Lupa password?</a>
                        </div>

                        <button class="btn btn-primary auth-btn">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Masuk
                        </button>

                    </form>

                    <div class="auth-footer">
                        Belum punya akun?
                        <a href="{{ route('mahasiswa.register') }}">Daftar sekarang</a>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection


@push('styles')
    <style>
        .auth-section {
            padding: 80px 0;
        }

        .auth-wrapper {
            display: flex;
            justify-content: center;
        }

        .auth-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-logo {
            width: 120px;
            margin-bottom: 10px;
        }

        .auth-header h2 {
            margin: 0;
            font-size: 22px;
        }

        .auth-header p {
            margin-top: 6px;
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 12px;
            gap: 10px;
        }

        .input-group i {
            color: #94a3b8;
        }

        .input-group input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .auth-options {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .auth-options a {
            color: #2563eb;
        }

        .auth-btn {
            width: 100%;
            padding: 12px;
            font-size: 15px;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .auth-footer a {
            color: #2563eb;
            font-weight: 600;
        }
    </style>
@endpush
