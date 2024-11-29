<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('pemiliks', PemilikController::class);
    Route::resource('hewans', HewanController::class);
    Route::resource('dokters', DokterController::class);
    Route::resource('jadwals', JadwalController::class);
    Route::resource('pemeriksaans', PemeriksaanController::class);

    Route::get('/riwayats', [PemeriksaanController::class, 'indexRiwayat'])->name('pemeriksaans.riwayat');
    Route::post('/pemeriksaans/{id}/riwayat', [PemeriksaanController::class, 'pindahKeRiwayat'])->name('pemeriksaans.pindahKeRiwayat');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

require __DIR__.'/auth.php';
