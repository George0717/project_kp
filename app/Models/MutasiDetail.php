<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'mutasi_id',
        'nama_barang',
        'merk',
        'kategori', 'no_inventaris', 'keterangan'
    ];

    public function mutasi()
    {
        return $this->belongsTo(Mutasi::class);
    }
}
