<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratJalan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nomorSurat',
        'tglKirim',
        'tujuanTempat',
        'foto',
        'divisi_pengirim',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id ?? null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->user()->id ?? null;
            $model->save();
        });
    }

    public function details()
    {
        return $this->hasMany(SuratJalanDetail::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

}

