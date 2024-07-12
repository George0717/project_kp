<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomorSurat',
        'tglKirim',
        'tujuanTempat',
        'foto',
        'divisi_pengirim'
    ];

    public $timestamps = true;

    public function details()
    {
        return $this->hasMany(SuratJalanDetail::class);
    }
}
