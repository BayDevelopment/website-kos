<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $table = 'kos';

    protected $fillable = [
        'user_id',
        'nama_kos',
        'slug',
        'deskripsi',
        'tipe_kos',
        'jenis_sewa',
        'harga_mulai',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'kode_pos',
        'latitude',
        'longitude',
        'kontak_nama',
        'kontak_wa',
        'is_active',
        'status',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // pemilik kos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kamar()
    {
        return $this->hasMany(KamarModel::class, 'kos_id');
    }


    // foto kos
    // public function fotos()
    // {
    //     return $this->hasMany(KosFoto::class);
    // }

    // // aturan kos
    // public function aturan()
    // {
    //     return $this->hasMany(KosAturan::class);
    // }

    // // kamar dalam kos
    // public function kamars()
    // {
    //     return $this->hasMany(Kamar::class);
    // }

    // // fasilitas kos (many to many)
    // public function fasilitas()
    // {
    //     return $this->belongsToMany(
    //         MasterFasilitas::class,
    //         'kos_master_fasilitas',
    //         'kos_id',
    //         'master_fasilitas_id'
    //     );
    // }

    // /*
    // |--------------------------------------------------------------------------
    // | HELPER
    // |--------------------------------------------------------------------------
    // */

    // // ambil foto cover
    // public function cover()
    // {
    //     return $this->hasOne(KosFoto::class)->where('is_cover', true);
    // }

    // // jumlah kamar
    // public function jumlahKamar()
    // {
    //     return $this->kamars()->count();
    // }

    // kamar tersedia
    public function kamarTersedia()
    {
        return $this->kamars()->where('tersedia', true)->count();
    }
}
