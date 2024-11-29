<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = "pemeriksaans";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'hewan_id',
        'dokter_id',  
        'tanggal_pemeriksaan_id',
        'jenis_perawatan',
        'vaksin',
        'harga',
        'deskripsi',
    ];

    
    // app/Models/Pemeriksaan.php
    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'tanggal_pemeriksaan_id');
    }
}
