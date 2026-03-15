@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="p-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-2xl font-bold">Kelola Kos</h1>
                <p class="text-sm text-gray-500" style="margin-bottom: 10px">
                    Kelola semua properti kos yang kamu miliki
                </p>
            </div>

            @if ($kos->isNotEmpty())
                <a href="{{ route('pemilik.kos.create') }}" class="btn-primary-dashboard" style="margin-bottom: 10px">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Kos
                </a>
            @endif

        </div>


        {{-- LIST KOS --}}
        <div class="kos-grid">

            @forelse($kos as $item)
                <div class="kos-card">

                    {{-- FOTO --}}
                    <div class="kos-image">
                        <img src="{{ $item->cover && Storage::disk('public')->exists($item->cover)
                            ? asset('storage/' . $item->cover)
                            : asset('image/default.png') }}"
                            alt="{{ $item->nama_kos }}">
                    </div>

                    <div class="kos-body">

                        {{-- HEADER --}}
                        <div class="kos-header">

                            <h3 class="kos-title">
                                {{ $item->nama_kos }}
                            </h3>

                            <span
                                class="kos-status
                        {{ $item->status == 'published' ? 'status-published' : '' }}
                        {{ $item->status == 'pending' ? 'status-pending' : '' }}
                        {{ $item->status == 'draft' ? 'status-draft' : '' }}
                    ">
                                {{ ucfirst($item->status) }}
                            </span>

                        </div>


                        {{-- LOKASI --}}
                        <p class="kos-location">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $item->kecamatan }}, {{ $item->kota }}
                        </p>


                        {{-- HARGA --}}
                        <p class="kos-price">
                            Mulai Rp {{ number_format($item->harga_mulai) }} / bulan
                        </p>


                        <div class="kos-actions">

                            <a href="{{ route('pemilik.kos.edit', $item->slug) }}" class="btn-edit text-decoration-none">
                                Edit
                            </a>

                            <div class="dropdown-setting">

                                <button class="btn-setting">
                                    <i class="fa-solid fa-gear"></i>
                                </button>

                                <div class="dropdown-menu-setting">
                                    <a href="{{ route('pemilik.kos.detail', $item->slug) }}">
                                        <i class="fa-solid fa-list"></i> Detail kos
                                    </a>

                                </div>

                            </div>

                            <form action="{{ route('pemilik.kos.destroy', $item->slug) }}" method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button class="btn-delete-kos">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="kos-empty">

                    <i class="fa-solid fa-building"></i>

                    <h3>Belum ada kos</h3>

                    <p>
                        Tambahkan kos pertama kamu untuk mulai menerima penyewa.
                    </p>

                    <a href="{{ route('pemilik.kos.create') }}" class="btn-primary-dashboard">
                        Tambah Kos
                    </a>

                </div>
            @endforelse

        </div>

    </div>
@endsection


@push('styles')
    <style>
        /* =========================
                                                                                                                                                                               KOS MANAGEMENT
                                                                                                                                                                            ========================= */

        .kos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .kos-card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 22px;
            /* overflow: hidden; */
            overflow: visible;
            box-shadow: var(--shadow);
            transition: all .25s ease;
        }

        .kos-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 35px rgba(15, 23, 42, .08);
        }

        /* FOTO */

        .kos-image {
            width: 100%;
            height: 190px;
            overflow: hidden;
        }

        .kos-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s ease;
        }

        .kos-card:hover .kos-image img {
            transform: scale(1.05);
        }

        /* BODY */

        .kos-body {
            padding: 18px;
        }

        /* HEADER */

        .kos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .kos-title {
            font-size: 18px;
            font-weight: 600;
        }

        /* LOKASI */

        .kos-location {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        /* HARGA */

        .kos-price {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 14px;
        }

        /* STATUS */

        .kos-status {
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 999px;
            font-weight: 600;
        }

        .status-published {
            background: var(--success-soft);
            color: #16a34a;
        }

        .status-pending {
            background: var(--warning-soft);
            color: #ea580c;
        }

        .status-draft {
            background: #f3f4f6;
            color: #374151;
        }

        /* ACTION */

        .kos-actions {
            display: flex;
            gap: 8px;
        }

        /* =========================
                                                                                                                                                                           BUTTON EFFECT
                                                                                                                                                                        ========================= */

        .kos-actions a,
        .kos-actions button {
            flex: 1;
            border: none;
            padding: 10px;
            border-radius: 12px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            transition: all .25s ease;
            position: relative;
        }

        /* HOVER EFFECT GLOBAL */
        .kos-actions a:hover,
        .kos-actions button:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 10px 20px rgba(15, 23, 42, .12);
        }

        /* ACTIVE CLICK EFFECT */
        .kos-actions a:active,
        .kos-actions button:active {
            transform: scale(.97);
            box-shadow: none;
        }

        /* EDIT */
        .btn-edit {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: #fff;
        }

        /* KAMAR */
        .btn-room {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-room:hover {
            background: #e5e7eb;
        }

        /* DELETE */
        .btn-delete-kos {
            background: #fee2e2;
            color: #dc2626;
            flex: 0;
            padding: 10px 12px;
        }

        .btn-delete-kos:hover {
            background: #dc2626;
            color: #fff;
        }

        /* EMPTY STATE */

        .kos-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 0;
        }

        .kos-empty i {
            font-size: 60px;
            color: #9ca3af;
            margin-bottom: 10px;
        }

        .kos-empty h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .kos-empty p {
            color: var(--muted);
            margin-bottom: 20px;
        }

        .btn-primary-dashboard:hover {
            text-decoration: none !important;
        }

        /* =========================
                                                                                                       FIX LINK DECORATION
                                                                                                    ========================= */

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        /* khusus button action */

        .kos-actions a {
            text-decoration: none;
        }

        .kos-actions a:hover {
            text-decoration: none;
        }

        /* setting dropdown */
        .dropdown-setting {
            position: relative;
        }

        /* tombol gear */
        .btn-setting {
            width: 38px;
            height: 38px;
            border: none;
            border-radius: 10px;
            background: #f3f4f6;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .btn-setting:hover {
            background: var(--primary);
            color: #fff;
        }

        /* dropdown keluar dari card */
        .dropdown-menu-setting {
            position: absolute;
            top: 45px;
            right: 0;
            min-width: 190px;

            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);

            display: none;
            flex-direction: column;

            z-index: 9999;
        }

        /* item */
        .dropdown-menu-setting a {
            padding: 12px 14px;
            font-size: 14px;
            text-decoration: none;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-menu-setting a:hover {
            background: #f3f4f6;
        }

        /* tampilkan dropdown */
        .dropdown-setting.active .dropdown-menu-setting {
            display: flex;
        }
    </style>
@endpush
@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll(".btn-delete-kos");

            deleteButtons.forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanent!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Tidak, batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // submit form
                            this.closest('form').submit();
                        }
                    });
                });
            });
        });

        // card setting buttom
        document.querySelectorAll(".btn-setting").forEach(btn => {

            btn.addEventListener("click", function(e) {

                e.stopPropagation()

                let dropdown = this.closest(".dropdown-setting")

                document.querySelectorAll(".dropdown-setting")
                    .forEach(d => d.classList.remove("active"))

                dropdown.classList.toggle("active")

            })

        })

        document.addEventListener("click", function() {
            document.querySelectorAll(".dropdown-setting")
                .forEach(d => d.classList.remove("active"))
        })
    </script>
@endpush
