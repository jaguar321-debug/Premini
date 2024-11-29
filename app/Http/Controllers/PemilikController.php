<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pemiliks = Pemilik::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('nomor_telepon', 'like', "%{$search}%")
                ->orWhere('gmail', 'like', "%{$search}%");
        })->get();
        // $pemiliks=Pemilik::where('nama', 'like', "%{$search}%")
        //         ->orWhere('alamat', 'like', "%{$search}%")
        //         ->orWhere('nomor_telepon', 'like', "%{$search}%")
        //         ->orWhere('gmail', 'like', "%{$search}%")->get();

        return view('pemiliks.index', compact('pemiliks'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemiliks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:10|duplicate_nomor_telepon:',
            'gmail' => 'required|duplicate_email',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'nomor_telepon.required' => 'No Telp harus diisi.',
            'nomor_telepon.max' => 'No Telp maksimal 10 angka.',
            'nomor_telepon.duplicate_nomor_telepon' => 'No Telp sudah digunakan.',
            'gmail.required' => 'Email harus diisi.',
            'gmail.duplicate_email' => 'Email sudah digunakan.',
        ]);

        Pemilik::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'gmail' => $request->gmail,
        ]);

        return redirect()->route('pemiliks.index')
            ->with('success', 'Pemilik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemilik $pemilik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemilik $pemilik)
    {
        return view('pemiliks.edit', compact('pemilik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemilik $pemilik)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required|max:10|duplicate_nomor_telepon:'. $pemilik->id,
            'gmail' => 'required|duplicate_email:'. $pemilik->id,
        ], [
            'nama.required' => 'Nama harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'nomor_telepon.required' => 'No Telp harus diisi.',
            'nomor_telepon.max' => 'No Telp maksimal 10 angka.',
            'nomor_telepon.duplicate_nomor_telepon' => 'No Telp sudah digunakan.',
            'gmail.required' => 'Email harus diisi.',
            'gmail.duplicate_email' => 'Email sudah digunakan.',
        ]);

        $pemilik->update($request->all());

        return redirect()->route('pemiliks.index')
            ->with('success', 'Pemilik berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();

        $this->reorderIds();

        return redirect()->route('pemiliks.index')->with('success', 'Pemilik dihapus dan ID diurutkan ulang dengan sukses.');
    }

    /**
     * Mengurutkan ulang ID setelah penghapusan.
     */
    public function reorderIds()
    {
        $pemiliks = Pemilik::orderBy('id')->get();
        $counter = 1;

        foreach ($pemiliks as $pemilik) {
            $pemilik->id = $counter++;
            $pemilik->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE pemiliks AUTO_INCREMENT = ' . ($counter));
    }
}
