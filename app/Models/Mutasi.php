<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $fillable = ['divisi_pengirim', 'penanggung_jawab', 'dibuat_oleh','lokasi', 'divisi_tujuan'];

    public function details()
    {
        return $this->hasMany(MutasiDetail::class);
    }
}
