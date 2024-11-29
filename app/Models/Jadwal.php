<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwals";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'tanggal_pemeriksaan',
        'hewan_id',
        'dokter_id',
        'waktu_pemeriksaan',
    ];

    // app/Models/Jadwal.php
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
