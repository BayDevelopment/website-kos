@extends('layouts.pemilik')

@section('content_pemilik')
    <div class="mhs-content">

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

                    <a href="{{ route('pemilik.kamar.index', $kos->slug) }}" class="btn-save-kamar">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Kamar
                    </a>

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

                                        <a href="#" class="btn-table">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <a href="#" class="btn-table danger">
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
    </style>
@endpush
