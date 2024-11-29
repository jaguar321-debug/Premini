<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Hewan;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jadwals = Jadwal::when($search, function ($query, $search) {
            return $query->where('tanggal_pemeriksaan', 'like', "%{$search}%")
                ->orWhere('waktu_pemeriksaan', 'like', "%{$search}%")
                ->orWhereHas('hewan', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('dokter', function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%");
                });
        })->with(['hewan', 'dokter'])->get(); // Pastikan hubungan hewan dan dokter dimuat

        return view('jadwals.index', compact('jadwals'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hewans = Hewan::all();
        $dokters = Dokter::all();
        return view('jadwals.create', compact('hewans', 'dokters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hewan_id' => 'required',
            'dokter_id' => 'required',
            'tanggal_pemeriksaan' => [
                'required',
                'after_or_equal:today',
                    function ($attribute, $value, $fail) use ($request) {
                        $exists = Jadwal::where('dokter_id', $request->dokter_id)
                            ->where('tanggal_pemeriksaan', $value)
                            ->where('waktu_pemeriksaan', $request->waktu_pemeriksaan)
                            ->exists();
                        if ($exists) {
                            $fail('Jadwal dengan dokter, tanggal, dan waktu yang sama sudah ada.');
                        }
                    },
            ],
            'waktu_pemeriksaan' => 'required',
        ], [
            'hewan_id.required' => 'Nama hewan harus diisi.',
            'dokter_id.required' => 'Dokter harus diisi.',
            'tanggal_pemeriksaan.required' => 'Tanggal Pemeriksaan harus diisi.',
            'tanggal_pemeriksaan.after_or_equal' => 'Tanggal Pemeriksaan tidak boleh kurang dari hari ini.',
            'waktu_pemeriksaan.required' => 'Waktu Pemeriksaan harus diisi.',
        ]);

        Jadwal::create([
            'hewan_id' => $request->hewan_id,
            'dokter_id' => $request->dokter_id,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'waktu_pemeriksaan' => $request->waktu_pemeriksaan,
        ]);

        return redirect()->route('jadwals.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hewans = Hewan::all();
        $dokters = Dokter::all();
        $jadwal = Jadwal::findOrFail($id);
        return view('jadwals.edit', compact('jadwal', 'hewans', 'dokters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'hewan_id' => 'required',
            'dokter_id' => 'required',
            'tanggal_pemeriksaan' => [
                'required',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request, $jadwal) {
                    $exists = Jadwal::where('dokter_id', $request->dokter_id)
                        ->where('tanggal_pemeriksaan', $value)
                        ->where('waktu_pemeriksaan', $request->waktu_pemeriksaan)
                        ->where('id', '!=', $jadwal->id) // Mengecualikan jadwal yang sedang diupdate
                        ->exists();
                    if ($exists) {
                        $fail('Jadwal dengan dokter, tanggal, dan waktu yang sama sudah ada.');
                    }
                },
            ],
            'waktu_pemeriksaan' => 'required',
        ], [
            'hewan_id.required' => 'Nama hewan harus diisi.',
            'dokter_id.required' => 'Dokter harus diisi.',
            'tanggal_pemeriksaan.required' => 'Tanggal Pemeriksaan harus diisi.',
            'tanggal_pemeriksaan.after_or_equal' => 'Tanggal Pemeriksaan tidak boleh kurang dari hari ini.',
            'waktu_pemeriksaan.required' => 'Waktu Pemeriksaan harus diisi.',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwals.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        $this->reorderIds();

        return redirect()->route('jadwals.index')->with('success', 'jadwal dihapus dan ID diurutkan ulang dengan sukses.');
    }

    /**
     * Mengurutkan ulang ID setelah penghapusan.
     */
    public function reorderIds()
    {
        $jadwals = Jadwal::orderBy('id')->get();
        $counter = 1;

        foreach ($jadwals as $jadwal) {
            $jadwal->id = $counter++;
            $jadwal->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE jadwals AUTO_INCREMENT = ' . ($counter));
    }
}
