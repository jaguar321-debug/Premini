<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table = "riwayats";
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

    public function getJenisPerawatanAttribute($value)
    {
        $jenis_perawatan = [
            1 => 'Grooming',
            2 => 'Bersihkan Kandang Hewan',
            // Tambahkan jenis perawatan lainnya sesuai kebutuhan
        ];
        

        return $jenis_perawatan[$value] ?? 'Jenis Perawatan Tidak Dikenal';
    }



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
