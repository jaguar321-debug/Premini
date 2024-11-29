<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dokters = Dokter::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%nira%");
                // ->orWhere('spesialis', 'like', "%{$search}%")
                // ->orWhere('nomor_telepon', 'like', "%{$search}%")
                // ->orWhere('gmail', 'like', "%{$search}%");
        })->get();

        // $dokters = Dokter::where('nama', 'like', "%nira%")->get();

        return view('dokters.index', compact('dokters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'spesialis' => 'required',
            'nomor_telepon' => 'required|max:10|duplicate_nomor_telepon',
            'gmail' => 'required|duplicate_email',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'spesialis.required' => 'Spesialis harus diisi.',
            'nomor_telepon.required' => 'No Telp harus diisi.',
            'nomor_telepon.max' => 'No Telp maksimal 10 angka.',
            'nomor_telepon.duplicate_nomor_telepon' => 'No Telp sudah digunakan.',
            'gmail.required' => 'Email harus diisi.',
            'gmail.duplicate_email' => 'Email sudah digunakan.',
        ]);

        Dokter::create([
            'nama' => $request->nama,
            'spesialis' => $request->spesialis,
            'nomor_telepon' => $request->nomor_telepon,
            'gmail' => $request->gmail,
        ]);

        return redirect()->route('dokters.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        return view('dokters.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required',
            'spesialis' => 'required',
            'nomor_telepon' => 'required|max:10|duplicate_nomor_telepon:' . $dokter->id,
            'gmail' => 'required|duplicate_email:' . $dokter->id,
        ], [
            'nama.required' => 'Nama harus diisi.',
            'spesialis.required' => 'Spesialis harus diisi.',
            'nomor_telepon.required' => 'No Telp harus diisi.',
            'nomor_telepon.max' => 'No Telp maksimal 10 angka.',
            'nomor_telepon.duplicate_nomor_telepon' => 'No Telp sudah digunakan.',
            'gmail.required' => 'Email harus diisi.',
            'gmail.duplicate_email' => 'Email sudah digunakan.',
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokters.index')
            ->with('success', 'Dokter berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        $this->reorderIds();

        return redirect()->route('dokters.index')->with('success', 'Dokter dihapus dan ID diurutkan ulang dengan sukses.');
    }

    /**
     * Mengurutkan ulang ID setelah penghapusan.
     */
    public function reorderIds()
    {
        $dokters = Dokter::orderBy('id')->get();
        $counter = 1;

        foreach ($dokters as $dokter) {
            $dokter->id = $counter++;
            $dokter->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE dokters AUTO_INCREMENT = ' . ($counter));
    }
}
