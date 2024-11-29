<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hewan; // Pastikan kamu sudah memiliki model Hewan
use App\Models\Dokter; // Pastikan kamu sudah memiliki model Dokter

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah hewan
        $jumlahHewan = Hewan::count();

        // Menghitung jumlah dokter
        $jumlahDokter = Dokter::count();

        // Mengirim data ke view
        return view('dashboard', [
            'jumlahHewan' => $jumlahHewan,
            'jumlahDokter' => $jumlahDokter,
        ]);
    }
}
