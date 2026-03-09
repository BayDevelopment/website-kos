@extends('layouts.auth')

@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="auth-wrapper">
                <div class="auth-card">

                    <div class="auth-header">
                        <img src="{{ asset('image/logo-nav.png') }}" class="auth-logo" alt="RoomKos">
                        <h2>Daftar Akun Mahasiswa</h2>
                        <p>Bikin akun dulu biar bisa simpan favorit dan hubungi pemilik kos.</p>
                    </div>

                    @if ($errors->any())
                        <div class="auth-alert">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <div>
                                <b>Periksa lagi</b>
                                <div>{{ $errors->first() }}</div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('mahasiswa.register.process') }}" class="auth-form">
                        @csrf

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Username"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="email@domain.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Konfirmasi password</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    <input type="password" name="password_confirmation" placeholder="Ulangi password"
                                        required>
                                </div>
                            </div>
                        </div>

                        <label class="check">
                            <input type="checkbox" name="policy_accepted_at" required>
                            <span>
                                Saya setuju dengan <a href="{{ route('terms') }}" class="link">Syarat & Ketentuan</a> dan
                                <a href="{{ route('privacy') }}" class="link">Kebijakan Privasi</a>.
                            </span>
                        </label>

                        <button class="btn btn-primary auth-btn" type="submit">
                            <i class="fa-solid fa-user-plus"></i>
                            Daftar
                        </button>
                    </form>

                    <div class="auth-footer">
                        Sudah punya akun?
                        <a href="{{ route('mahasiswa.login') }}">Masuk</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .auth-section {
            padding: 80px 0
        }

        .auth-wrapper {
            display: flex;
            justify-content: center
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 26px
        }

        .auth-logo {
            width: 120px;
            margin-bottom: 10px
        }

        .auth-header h2 {
            margin: 0;
            font-size: 22px;
            color: #0f172a
        }

        .auth-header p {
            margin-top: 6px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6
        }

        .auth-alert {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            font-size: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        @media (max-width:640px) {
            .auth-card {
                padding: 28px
            }

            .form-grid {
                grid-template-columns: 1fr
            }
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #0f172a;
            font-size: 14px;
        }

        .input-group {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 12px;
            background: #fff;
        }

        .input-group i {
            color: #94a3b8
        }

        .input-group input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: #0f172a;
        }

        .check {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin: 16px 0 18px;
            font-size: 13.5px;
            color: #334155;
        }

        .check input {
            margin-top: 3px
        }

        .link {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none
        }

        .link:hover {
            text-decoration: underline
        }

        .auth-btn {
            width: 100%;
            padding: 12px;
            font-size: 15px
        }

        .auth-footer {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #334155;
        }

        .auth-footer a {
            color: #2563eb;
            font-weight: 600
        }
    </style>
@endpush
