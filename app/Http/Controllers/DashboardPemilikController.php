<?php

namespace App\Http\Controllers;

use App\Models\KamarModel;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Pemilik | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Dashboard'
        ];
        return view('pemilik.dashboard', $data);
    }

    public function indexKos()
    {
        $kos = Kos::where('user_id', Auth::id())->latest()->get();

        return view('pemilik.kelola-kos', [
            'title' => 'Kelola Kos | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Kelola Kos',
            'kos' => $kos
        ]);
    }

    public function createKos()
    {
        return view('pemilik.create-kos', [
            'title' => 'Create Kos | RoomKos Daerah Cilegon & Serang',
            'navlink' => "Create Kos"
        ]);
    }


    public function prosesCreateKos(Request $request)
    {
        $request->validate([

            'nama_kos' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',

            'tipe_kos' => 'required|in:putra,putri,campur',
            'jenis_sewa' => 'required|in:harian,bulanan,tahunan',

            'harga_mulai' => 'nullable|numeric|min:0',

            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'nullable|string|max:100',

            'alamat_lengkap' => 'required|string|max:500',

            'kode_pos' => 'nullable|digits_between:5,6',

            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',

            'kontak_nama' => 'nullable|string|max:100',
            'kontak_wa' => 'nullable|string|max:20',

            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);


        /*
    |------------------------------------------
    | SANITASI INPUT
    |------------------------------------------
    */

        $namaKos = trim(strip_tags($request->nama_kos));
        $deskripsi = $request->deskripsi ? trim(strip_tags($request->deskripsi)) : null;
        $alamat = trim(strip_tags($request->alamat_lengkap));

        $provinsi = trim(strip_tags($request->provinsi));
        $kota = trim(strip_tags($request->kota));
        $kecamatan = trim(strip_tags($request->kecamatan));
        $kelurahan = $request->kelurahan ? trim(strip_tags($request->kelurahan)) : null;


        /*
    |------------------------------------------
    | GENERATE SLUG AMAN
    |------------------------------------------
    */

        $baseSlug = Str::slug($namaKos);

        if (!$baseSlug) {
            $baseSlug = 'kos';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (Kos::where('slug', $slug)->exists()) {

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }


        /*
    |------------------------------------------
    | UPLOAD COVER
    |------------------------------------------
    */

        $coverPath = null;

        if ($request->hasFile('cover')) {

            $coverPath = $request->file('cover')->store('kos', 'public');
        }


        /*
    |------------------------------------------
    | FORMAT WHATSAPP
    |------------------------------------------
    */

        $kontakWa = $request->kontak_wa
            ? preg_replace('/[^0-9]/', '', $request->kontak_wa)
            : null;


        /*
    |------------------------------------------
    | SIMPAN DATA
    |------------------------------------------
    */

        DB::beginTransaction();

        try {

            Kos::create([

                'user_id' => Auth::id(),

                'nama_kos' => $namaKos,
                'slug' => $slug,
                'deskripsi' => $deskripsi,

                'tipe_kos' => $request->tipe_kos,
                'jenis_sewa' => $request->jenis_sewa,

                'harga_mulai' => $request->harga_mulai,

                'provinsi' => $provinsi,
                'kota' => $kota,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,

                'alamat_lengkap' => $alamat,
                'kode_pos' => $request->kode_pos,

                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

                'kontak_nama' => $request->kontak_nama,
                'kontak_wa' => $kontakWa,

                'is_active' => true,
                'status' => 'draft',

                'published_at' => null,

                'cover' => $coverPath

            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal membuat kos. Silakan coba lagi.');
        }


        return redirect()
            ->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil dibuat');
    }

    public function editKos($slug)
    {
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('pemilik.edit-kos', [
            'title' => 'Edit Kos | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Edit Kos',
            'kos' => $kos
        ]);
    }

    public function prosesEditKos(Request $request, $slug)
    {
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',

            'tipe_kos' => 'required|in:putra,putri,campur',
            'jenis_sewa' => 'required|in:harian,bulanan,tahunan',

            'harga_mulai' => 'nullable|numeric|min:0',

            'provinsi' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'nullable|string|max:100',

            'alamat_lengkap' => 'required|string|max:500',

            'kode_pos' => 'nullable|string|max:10',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'kontak_nama' => 'nullable|string|max:100',
            'kontak_wa' => 'nullable|string|max:20',
        ]);

        // Sanitasi input
        $namaKos = trim(strip_tags($request->nama_kos));
        $deskripsi = $request->deskripsi ? trim(strip_tags($request->deskripsi)) : null;
        $alamat = trim(strip_tags($request->alamat_lengkap));
        $provinsi = trim(strip_tags($request->provinsi));
        $kota = trim(strip_tags($request->kota));
        $kecamatan = trim(strip_tags($request->kecamatan));
        $kelurahan = $request->kelurahan ? trim(strip_tags($request->kelurahan)) : null;
        $kontakWa = $request->kontak_wa ? preg_replace('/[^0-9]/', '', $request->kontak_wa) : null;

        // Generate slug jika nama berubah
        $slug = $kos->slug;
        if ($namaKos !== $kos->nama_kos) {
            $baseSlug = Str::slug($namaKos) ?: 'kos';
            $counter = 1;
            while (Kos::where('slug', $baseSlug)->where('id', '!=', $kos->id)->exists()) {
                $baseSlug = Str::slug($namaKos) . '-' . $counter;
                $counter++;
            }
            $slug = $baseSlug;
        }

        // Update data
        DB::beginTransaction();
        try {
            $kos->update([
                'nama_kos' => $namaKos,
                'slug' => $slug,
                'deskripsi' => $deskripsi,
                'tipe_kos' => $request->tipe_kos,
                'jenis_sewa' => $request->jenis_sewa,
                'harga_mulai' => $request->harga_mulai,
                'provinsi' => $provinsi,
                'kota' => $kota,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'alamat_lengkap' => $alamat,
                'kode_pos' => $request->kode_pos,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'kontak_nama' => $request->kontak_nama,
                'kontak_wa' => $kontakWa,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal mengupdate kos.');
        }

        return redirect()->route('pemilik.kos.index')->with('success', 'Kos berhasil diperbarui');
    }

    public function deleteKos($slug)
    {
        // Ambil kos milik user berdasarkan slug
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hapus gambar jika ada dan bukan default
        if ($kos->gambar && $kos->gambar !== 'default.png') {
            // Pastikan file ada
            if (Storage::disk('public')->exists('kos/' . $kos->gambar)) {
                Storage::disk('public')->delete('kos/' . $kos->gambar);
            }
        }

        // Hapus data kos
        $kos->delete();

        return redirect()->route('pemilik.kos.index')->with('success', 'Kos berhasil dihapus.');
    }

    // FOTO
    public function fotoKos()
    {
        $data = [
            'title' => 'Foto | RoomKos Daerah Cilegon & Serang'
        ];
        return view('pemilik.create-foto-kos', $data);
    }


    // KAMAR
    public function createKamar($slug)
    {
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $lastKamar = KamarModel::where('kos_id', $kos->id)
            ->orderBy('kode_kamar', 'desc')
            ->first();

        if ($lastKamar) {
            preg_match('/\d+$/', $lastKamar->kode_kamar, $match);
            $nextNumber = (int)$match[0] + 1;
        } else {
            $nextNumber = 1;
        }

        $kodeKamar = 'KMR-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $data = [
            'title' => 'Tambah Kamar | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Tambah Kamar',
            'kos' => $kos,
            'kodeKamar' => $kodeKamar
        ];


        return view('pemilik.create-kamar-kos', $data);
    }


    public function storeKamar(Request $request, $slug)
    {
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'nama_kamar' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'deposit' => 'nullable|numeric|min:0',
            'luas' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {

            // Ambil kamar terakhir dalam kos ini
            $lastKamar = KamarModel::where('kos_id', $kos->id)
                ->orderBy('kode_kamar', 'desc')
                ->first();

            if ($lastKamar) {

                preg_match('/\d+$/', $lastKamar->kode_kamar, $match);
                $lastNumber = isset($match[0]) ? (int) $match[0] : 0;

                $newNumber = $lastNumber + 1;
            } else {

                $newNumber = 1;
            }

            // Format kode kamar
            $kodeKamar = 'KMR-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            KamarModel::create([
                'kos_id' => $kos->id,
                'nama_kamar' => $request->nama_kamar,
                'kode_kamar' => $kodeKamar,
                'harga' => $request->harga,
                'deposit' => $request->deposit,
                'luas' => $request->luas,
                'stok' => $request->stok,
                'tersedia' => $request->tersedia ?? true,
                'deskripsi' => $request->deskripsi
            ]);

            DB::commit();

            return redirect()
                ->route('pemilik.kos.detail', $kos->slug)
                ->with('success', 'Kamar berhasil ditambahkan');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan kamar');
        }
    }



    public function editKamar($slugKos, $kodeKamar)
    {
        $kos = Kos::where('slug', $slugKos)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $kamar = KamarModel::where('kode_kamar', $kodeKamar)
            ->where('kos_id', $kos->id)
            ->firstOrFail();

        $data = [
            'title' => 'Edit Kamar | RoomKos Daerah Cilegon & Serang',
            'navlink' => 'Edit Kamar',
            'kos' => $kos,
            'kamar' => $kamar
        ];

        return view('pemilik.edit-kamar-kos', $data);
    }

    public function updateKamar(Request $request, $slugKos, $kodeKamar)
    {
        $kos = Kos::where('slug', $slugKos)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $kamar = KamarModel::where('kode_kamar', $kodeKamar)
            ->where('kos_id', $kos->id)
            ->firstOrFail();

        $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'deposit' => 'nullable|numeric|min:0',
            'luas' => 'nullable|integer|min:1',
            'deskripsi' => 'nullable|string'
        ]);

        $kamar->update([
            'nama_kamar' => $request->nama_kamar,
            'harga' => $request->harga,
            'deposit' => $request->deposit,
            'luas' => $request->luas,
            'stok' => $request->stok,
            'tersedia' => $request->tersedia ?? true,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()
            ->route('pemilik.kos.detail', $kos->slug)
            ->with('success', 'Kamar berhasil diperbarui');
    }

    public function deleteKamar($slugKos, $kodeKamar)
    {
        // Ambil kos milik user
        $kos = Kos::where('slug', $slugKos)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Ambil kamar berdasarkan kode kamar dan kos
        $kamar = KamarModel::where('kode_kamar', $kodeKamar)
            ->where('kos_id', $kos->id)
            ->firstOrFail();

        // Hapus kamar
        $kamar->delete();

        return redirect()
            ->route('pemilik.kos.detail', $kos->slug)
            ->with('success', 'Kamar berhasil dihapus.');
    }

    public function detailKos($slug)
    {
        $kos = Kos::where('slug', $slug)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $kamar = KamarModel::where('kos_id', $kos->id)
            ->latest()
            ->paginate(10);

        return view('pemilik.detail-kos', [
            'title' => 'Detail Kos | RoomKos',
            'navlink' => 'Detail Kos',
            'kos' => $kos,
            'kamar' => $kamar
        ]);
    }
}
