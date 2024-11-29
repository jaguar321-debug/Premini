<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;
    protected $table = "hewans";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'jenis',
        'ras',
        'umur',
        'image',
        'pemilik_id',
    ];

    // app/Models/Hewan.php
    public function getJenisAttribute($value)
    {
        $jenis = [
            1 => 'Kucing',
            2 => 'Bunglon',
            3 => 'Anjing',
            4 => 'Kura-Kura',
            5 => 'Merpati',
        ];

        return $jenis[$value];
    }

    public function getRasAttribute($value)
    {
        $ras = [
            1 => 'Mamalia',
            2 => 'Unggas',
            3 => 'Reptil',
        ];

        return $ras[$value];
    }

    public function getJenisIdAttribute()
    {
        return $this->attributes['jenis'];
    }

    // app/Models/Hewan.php
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
