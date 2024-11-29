<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = "pemiliks";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'nomor_telepon',
        'gmail',
    ];

    // app/Models/Pemilik.php
    public function hewans()
    {
        return $this->hasMany(Hewan::class);
    }
}
