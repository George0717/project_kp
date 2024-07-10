<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_jalan_id',
        'namaBarang',
        'jumlahBarang',
    ];

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class);
    }
    public $timestamps = true;
}
