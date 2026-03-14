<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarModel extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'kos_id',
        'nama_kamar',
        'kode_kamar',
        'harga',
        'deposit',
        'luas',
        'stok',
        'tersedia',
        'deskripsi'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'deposit' => 'decimal:2',
        'tersedia' => 'boolean',
        'stok' => 'integer',
        'luas' => 'integer'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
