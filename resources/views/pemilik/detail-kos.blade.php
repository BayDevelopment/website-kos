@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="mhs-content">

        {{-- tombol kembali --}}
        <a href="{{ route('pemilik.kos.index', $kos->slug) }}" class="btn-back-kamar">
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

            {{-- LIST KAMAR --}}
            <div class="content-card">

                <div class="card-head">
                    <div>
                        <h2>Daftar Kamar</h2>
                        <p>Kamar yang tersedia pada kos ini</p>
                    </div>

                    <div class="action-dropdown">

                        <button class="btn-save-kamar btn-action-toggle" type="button">
                            <i class="fa-solid fa-plus"></i>
                            Tambah
                        </button>

                        <div class="dropdown-action-menu">

                            <a href="{{ route('pemilik.kamar.index', $kos->slug) }}">
                                <i class="fa-solid fa-bed"></i>
                                Kamar
                            </a>

                            <a href="#">
                                <i class="fa-solid fa-building"></i>
                                Fasilitas
                            </a>

                            <a href="#">
                                <i class="fa-solid fa-image"></i>
                                Gambar
                            </a>

                        </div>

                    </div>


                </div>

                <div class="table-responsive">

                    <table class="table-kamar">

                        <thead>
                            <tr>
                                <th>Nama Kamar</th>
                                <th>Kode</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($kamar as $item)
                                <tr>

                                    <td>{{ $item->nama_kamar }}</td>

                                    <td>{{ $item->kode_kamar }}</td>

                                    <td>
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>

                                    <td>{{ $item->stok }}</td>

                                    <td>

                                        @if ($item->tersedia)
                                            <span class="badge badge-success">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Tidak Tersedia
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('pemilik.kamar.edit', [$kos->slug, $item->kode_kamar]) }}"
                                            class="btn-table">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>



                                        <a href="#" class="btn-table danger btn-delete-kamar"
                                            data-url="{{ route('pemilik.kamar.destroy', [$kos->slug, $item->kode_kamar]) }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>


                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" style="text-align:center">
                                        Belum ada kamar
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                    <form id="deleteForm" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>

                {{-- PAGINATION --}}
                <div class="pagination-wrap">
                    {{ $kamar->links() }}
                </div>

            </div>

        </div>
    </div>
@endsection
@push('styles')
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* smooth scroll di iOS */
        }

        .table-kamar {
            width: 100%;
            min-width: 650px;
            /* supaya tabel tidak mengecil */
            border-collapse: collapse;
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .table-kamar th,
        .table-kamar td {
            white-space: nowrap;
        }

        /* CARD INFO KOS */
        .kos-info-wrap {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        /* gambar kos */
        .kos-info-img {
            width: 110px;
            height: 90px;
            min-width: 110px;
            border-radius: 12px;
            object-fit: cover;
        }

        /* teks kos */
        .kos-info-text {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .kos-info-text h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        /* lokasi */
        .kos-info-location {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        /* tag tipe kos */
        .tag {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 20px;
            background: #eef2ff;
            color: #4338ca;
            width: fit-content;
        }


        .table-kamar {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table-kamar th {
            text-align: left;
            font-size: 13px;
            color: #6b7280;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .table-kamar td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f1f1;
            font-size: 14px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-table {
            padding: 6px 10px;
            border-radius: 6px;
            background: #f3f4f6;
            color: #333;
            margin-right: 5px;
        }

        .btn-table.danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .pagination-wrap {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        @media (max-width:768px) {

            .kos-info-wrap {
                flex-direction: column;
                align-items: flex-start;
            }

            .kos-info-img {
                width: 100%;
                height: 180px;
            }

        }

        /* dropdown aksi */
        .action-dropdown {
            position: relative;
        }

        /* menu dropdown */
        .dropdown-action-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            min-width: 180px;
            padding: 6px;
            display: none;
            flex-direction: column;
            z-index: 50;
        }

        /* item menu */
        .dropdown-action-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            transition: 0.2s;
        }

        .dropdown-action-menu a:hover {
            background: #f3f4f6;
        }

        /* show dropdown */
        .action-dropdown.active .dropdown-action-menu {
            display: flex;
        }

        /* responsive */
        @media(max-width:768px) {

            .dropdown-action-menu {
                right: auto;
                left: 0;
                width: 200px;
            }

        }

        /* tombol tambah (reuse style btn-save-kamar) */
        .btn-save-kamar {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s ease;
            text-decoration: none;
        }

        .btn-save-kamar i {
            font-size: 13px;
        }

        /* hover effect */
        .btn-save-kamar:hover {
            background: var(--primary);
        }

        /* dropdown container */
        .action-dropdown {
            position: relative;
            display: inline-block;
        }

        /* dropdown menu */
        .dropdown-action-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            min-width: 180px;
            padding: 6px;
            display: none;
            flex-direction: column;
            z-index: 50;
        }

        /* dropdown item */
        .dropdown-action-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            color: #374151;
            transition: 0.2s;
        }

        .dropdown-action-menu a:hover {
            background: #f3f4f6;
        }

        /* tampilkan dropdown */
        .action-dropdown.active .dropdown-action-menu {
            display: flex;
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
        document.querySelectorAll(".btn-action-toggle").forEach(btn => {

            btn.addEventListener("click", function(e) {

                e.stopPropagation()

                const parent = this.closest(".action-dropdown")

                parent.classList.toggle("active")

            })

        })

        document.addEventListener("click", function() {

            document.querySelectorAll(".action-dropdown")
                .forEach(el => el.classList.remove("active"))

        })

        // delete kamar
        document.querySelectorAll(".btn-delete-kamar").forEach(button => {

            button.addEventListener("click", function(e) {

                e.preventDefault();

                const url = this.dataset.url;

                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Data kamar ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ef4444",
                    cancelButtonColor: "#6b7280",
                    confirmButtonText: "Ya, Hapus",
                    cancelButtonText: "Batal"
                }).then((result) => {

                    if (result.isConfirmed) {

                        const form = document.getElementById("deleteForm");

                        form.action = url;
                        form.submit();

                    }

                });

            });

        });
    </script>
@endpush
