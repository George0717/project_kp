<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $fillable = [ 'penanggung_jawab', 'dibuat_oleh','lokasi', 'divisi_tujuan', 'foto_mutasi', 'tgl_buat'];

    public function details()
    {
        return $this->hasMany(MutasiDetail::class);
    }
}
