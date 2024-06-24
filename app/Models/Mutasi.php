<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [ 'id','divisi_pengirim', 'penanggung_jawab', 'dibuat_oleh','lokasi', 'divisi_tujuan', 'nama_barang', 'merk', 'model', 'kategori', 'no_inventaris', 'keterangan'];
}
