<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tindakan extends Model
{
    use HasFactory;

    protected $table = 'tindakan';

    protected $fillable = [
        'periksa_id',
        'layanan_id',
        'lokasi',
        'uang_masuk',
        'fee_dokter',
        'pendapatan_klinik',
    ];

    public function periksa()
    {
        return $this->belongsTo(Periksa::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
