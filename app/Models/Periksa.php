<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksa';

    protected $fillable = [
        'patient_id',
        'dokter_id',
        'keluhan',
        'diagnosa',
        'waktu_kedatangan',
        'status',
    ];

    // Relasi ke pasien
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi ke dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

 public function tindakan()
{
    return $this->hasMany(Tindakan::class);
}

}
