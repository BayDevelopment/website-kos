<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasFactory;

    protected $table = 'universitas';

    protected $fillable = [
        'nama_universitas',
        'slug',
        'jenis',
        'kota',
        'alamat',
        'website',
        'logo',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function identitasMahasiswa()
    {
        return $this->hasMany(IdentitasMahasiswa::class);
    }
}
