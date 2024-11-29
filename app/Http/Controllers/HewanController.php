<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Import DB facade

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $hewans = Hewan::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('jenis', 'like', "%{$search}%")
                ->orWhere('ras', 'like', "%{$search}%")
                ->orWhere('umur', 'like', "%{$search}%");
        })->with('pemilik')->get(); // Pastikan hubungan pemilik dimuat

        return view('hewans.index', compact('hewans'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemiliks = Pemilik::all();
        return view('hewans.create', compact('pemiliks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|integer',
            'ras' => 'required|integer',
            'umur' => 'required|integer',
            'pemilik_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama hewan harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'ras.required' => 'Ras harus diisi.',
            'umur.required' => 'Umur harus diisi.',
            'pemilik_id.required' => 'Pemilik tidak boleh kosong.',
            'image.required' => 'Gambar harus diisi.',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Hewan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'ras' => $request->ras,
            'umur' => $request->umur,
            'pemilik_id' => $request->pemilik_id,
            'image' => $path,
        ]);

        return redirect()->route('hewans.index')->with('success', 'Hewan berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hewan = Hewan::findOrFail($id);
        return view('hewans.show', compact('hewan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pemiliks = Pemilik::all();
        $hewan = Hewan::findOrFail($id);
        return view('hewans.edit', compact('hewan', 'pemiliks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|integer',
            'ras' => 'required|integer',
            'umur' => 'required|integer',
            'pemilik_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama hewan harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'ras.required' => 'Ras harus diisi.',
            'umur.required' => 'Umur harus diisi.',
            'pemilik_id.required' => 'Pemilik tidak boleh kosong.',
        ]);

        // $hewan->nama = $request->nama;
        // $hewan->jenis = $request->jenis;
        // $hewan->ras = $request->ras;
        // $hewan->umur = $request->umur;
        // $hewan->pemilik_id = $request->pemilik_id;
        $data = $request->all();
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($hewan->image && Storage::disk('public')->exists($hewan->image)) {
                Storage::disk('public')->delete($hewan->image);
            }

            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            // $hewan->image = $path;
            $data['image'] = $path;
        }

        // $hewan->save();
        dd($data);
        $hewan->update($data);

        return redirect()->route('hewans.index')
            ->with('success', 'Hewan Berhasil Di Edit.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hewan = Hewan::findOrFail($id);
        // Hapus gambar jika ada
        if ($hewan->image && Storage::disk('public')->exists($hewan->image)) {
            Storage::disk('public')->delete($hewan->image);
        }
        $hewan->delete();

        $this->reorderIds();

        return redirect()->route('hewans.index')->with('success', 'hewan dihapus dan ID diurutkan ulang dengan sukses.');
    }

    /**
     * Mengurutkan ulang ID setelah penghapusan.
     */
    public function reorderIds()
    {
        $hewans = Hewan::orderBy('id')->get();
        $counter = 1;

        foreach ($hewans as $hewan) {
            $hewan->id = $counter++;
            $hewan->save();
        }

        // Setel ulang nilai auto-increment ke ID tertinggi + 1
        DB::statement('ALTER TABLE hewans AUTO_INCREMENT = ' . ($counter));
    }
}
