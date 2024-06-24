<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratJalan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'surat_jalans';
    protected $fillable = [ 'nomorSurat', 'tglKirim', 'namaBarang','jumlahBarang','tujuanTempat'];
    protected $cast = ['namaBarang' => 'array', 'jumlahBarang' => 'array'];
    public function detailBarangs()
    {
        return $this->hasMany(DetailBarang::class);
    }
    

    
}
