<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ID pengguna yang melakukan tindakan
        'action',  // Tindakan yang dilakukan (create, update, delete)
        'model',   // Nama model terkait (SuratJalan, SuratJalanDetail, dll.)
    ];

    // Relasi dengan pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
