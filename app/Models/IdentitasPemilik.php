<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentitasPemilik extends Model
{
    use HasFactory;

    protected $table = 'identitas_pemilik';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'alamat',
        'no_wa',
        'avatar',
        'foto_ktp',
        'foto_selfie',
        'nama_usaha',
        'status_pengelola',
        'is_complete',
        'verification_status',
        'verification_note',
        'verified_at',
    ];

    protected $casts = [
        'is_complete' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHOD
    |--------------------------------------------------------------------------
    */

    public function isApproved()
    {
        return $this->verification_status === 'approved';
    }

    public function isPending()
    {
        return $this->verification_status === 'pending';
    }

    public function isRejected()
    {
        return $this->verification_status === 'rejected';
    }
}
