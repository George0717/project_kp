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
        'foto'
    ];

    public $timestamps = true;

    public function details()
    {
        return $this->hasMany(SuratJalanDetail::class);
    }
}
