<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = "dokters";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'spesialis',
        'nomor_telepon',
        'gmail',
    ];

    public function getSpesialisAttribute($value)
    {
        $spessialis = [
            1 => 'Mata',
            2 => 'Kulit',
            3 => 'Pencernaan',
            4 => 'Gigi',
            5 => 'Bulu',
        ];

        return $spessialis[$value];
    }

    // app/Models/Dokter.php
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
