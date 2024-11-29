<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Riwayat;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pemeriksaans = Pemeriksaan::when($search, function ($query, $search) {
            return $query->where('jenis_perawatan', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('vaksin', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%")
                ->orWhereHas('hewan', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('dokter', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('jadwal', function ($query) use ($search) {
                    $query->where('tanggal_pemeriksaan', 'like', "%{$search}%");
                });
        })->with(['hewan', 'dokter', 'jadwal'])->get(); // Pastikan hubungan hewan dan dokter dimuat

        return view('pemeriksaans.index', compact('pemeriksaans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hewans = Hewan::all();
        $dokters = Dokter::all();
        $jadwals = Jadwal::all();
        return view('pemeriksaans.create', compact('hewans', 'dokters', 'jadwals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required',
            'dokter_id' => 'required',
            'tanggal_pemeriksaan_id' => 'required',
            'jenis_perawatan' => 'required',
            'vaksin' => 'required',
            'harga' => 'required|numeric|min:0', // Pastikan harga adalah angka dan minimal 0
            'deskripsi' => 'required',
        ], [
            'hewan_id.required' => 'Nama hewan harus diisi.',
            'dokter_id.required' => 'Dokter_id harus diisi.',
            'tanggal_pemeriksaan_id.required' => 'Tanggal Perawatan harus diisi.',
            'jenis_perawatan.required' => 'Jenis harus diisi.',
            'vaksin.required' => 'Vaksin harus diisi.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
        ]);

        Pemeriksaan::create([
            'hewan_id' => $request->hewan_id,
            'dokter_id' => $request->dokter_id,
            'tanggal_pemeriksaan_id' => $request->tanggal_pemeriksaan_id,
            'jenis_perawatan' => $request->jenis_perawatan,
            'vaksin' => $request->vaksin,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('pemeriksaans.index')
            ->with('success', 'Pemeriksaan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hewans = Hewan::all();
        $dokters = Dokter::all();
        $jadwals = Jadwal::all();
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        return view('pemeriksaans.edit', compact('pemeriksaan', 'hewans', 'dokters', 'jadwals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $request->validate([
            'hewan_id' => 'required',
            'dokter_id' => 'required',
            'tanggal_pemeriksaan_id' => 'required',
            'jenis_perawatan' => 'required',
            'vaksin' => 'required',
            'harga' => 'required|numeric|min:0', // Pastikan harga adalah angka dan minimal 0
            'deskripsi' => 'required',
        ], [
            'hewan_id.required' => 'Nama hewan harus diisi.',
            'dokter_id.required' => 'Dokter_id harus diisi.',
            'tanggal_pemeriksaan_id.required' => 'Tanggal Perawatan harus diisi.',
            'jenis_perawatan.required' => 'Jenis harus diisi.',
            'vaksin.required' => 'Vaksin harus diisi.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
        ]);

        $pemeriksaan->update($request->all());

        return redirect()->route('pemeriksaans.index')
            ->with('success', 'pemeriksaan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->delete();

        $this->reorderIds();

        return redirect()->route('pemeriksaans.index')->with('success', 'Pemeriksaan dihapus dan No diurutkan ulang dengan sukses.');
    }

    public function pindahKeRiwayat($id)
    {
        // Ambil data dari tabel pemeriksaan berdasarkan ID
        $pemeriksaan = Pemeriksaan::find($id);

        if (!$pemeriksaan) {
            // Jika data tidak ditemukan, arahkan kembali dengan pesan error
            return redirect()->route('pemeriksaans.index')->with('error', 'Data pemeriksaan tidak ditemukan.');
        }

        // Buat entitas baru di tabel riwayat
        Riwayat::create([
            'hewan_id' => $pemeriksaan->hewan_id,
            'dokter_id' => $pemeriksaan->dokter_id,
            'tanggal_pemeriksaan_id' => $pemeriksaan->tanggal_pemeriksaan_id,
            'jenis_perawatan' => $pemeriksaan->jenis_perawatan, // Pastikan ini adalah angka
            'vaksin' => $pemeriksaan->vaksin,
            'harga' => $pemeriksaan->harga,
            'deskripsi' => $pemeriksaan->deskripsi,
        ]);

        // Hapus data dari tabel pemeriksaan
        $pemeriksaan->delete();

        // Panggil metode untuk mengurutkan ulang ID jika diperlukan
        $this->reorderIds();

        // Arahkan kembali dengan pesan sukses
        return redirect()->route('pemeriksaans.index')->with('success', 'Data berhasil dipindahkan ke Riwayat.');
    }


    /**
     * Mengurutkan ulang ID setelah penghapusan.
     */
    public function reorderIds()
    {
        $pemeriksaans = Pemeriksaan::orderBy('id')->get();
        $counter = 1;

        foreach ($pemeriksaans as $pemeriksaan) {
            $pemeriksaan->id = $counter++;
            $pemeriksaan->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE pemeriksaans AUTO_INCREMENT = ' . ($counter));
    }

    public function indexRiwayat()
    {
        $riwayats = Riwayat::all(); // Ambil semua data dari tabel riwayat
        return view('pemeriksaans.riwayat', compact('riwayats'));
    }
}
