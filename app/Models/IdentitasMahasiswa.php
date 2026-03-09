<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdentitasMahasiswa extends Model
{
    protected $table = 'identitas_mahasiswas';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'asal_universitas',
        'semester',
        'nik',
        'jenis_kelamin',
        'asal_kota',
        'alamat',
        'no_wa',
        'avatar',
        'is_complete',
        'verification_status',
        'verification_note',
        'verified_at',
    ];

    protected $casts = [
        'semester' => 'integer',
        'is_complete' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
