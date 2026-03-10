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
        'universitas_id',
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
    public function universitas()
    {
        return $this->belongsTo(Universitas::class);
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        if ($this->jenis_kelamin === 'laki-laki') {
            return asset('image/avatar/man.png');
        }

        if ($this->jenis_kelamin === 'perempuan') {
            return asset('image/avatar/woman.png');
        }

        return asset('image/avatar/profile.png');
    }
}
