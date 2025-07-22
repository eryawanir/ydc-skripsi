<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_sertifikat',
        'tempat_lahir',
        'tanggal_lahir',
        'no_hp',
        'nik',
        'alamat',
        'tipe_dokter',
    ];

    /**
     * Relasi ke user (jika dokter punya akun login).
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
