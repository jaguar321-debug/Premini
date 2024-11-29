<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hewan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('hewans.update', $hewan->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                    name="nama" value="{{ old('nama', $hewan->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select class="form-control @error('jenis') is-invalid @enderror" id="jenis"
                    name="jenis" required>
                    <option value="" disabled>-- Pilih Jenis --</option>
                    <option value="1" {{ old('jenis', $hewan->jenis) == 1 ? 'selected' : '' }}>Kucing</option>
                    <option value="2" {{ old('jenis', $hewan->jenis) == 2 ? 'selected' : '' }}>Bunglon</option>
                    <option value="3" {{ old('jenis', $hewan->jenis) == 3 ? 'selected' : '' }}>Anjing</option>
                    <option value="4" {{ old('jenis', $hewan->jenis) == 4 ? 'selected' : '' }}>Kura-Kura</option>
                    <option value="5" {{ old('jenis', $hewan->jenis) == 5 ? 'selected' : '' }}>Merpati</option>
                </select>
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ras">Ras</label>
                <select class="form-control @error('ras') is-invalid @enderror" id="ras"
                    name="ras" required>
                    <option value="" disabled>-- Pilih Ras --</option>
                    <option value="1" {{ old('ras', $hewan->ras) == 1 ? 'selected' : '' }}>Mamalia</option>
                    <option value="2" {{ old('ras', $hewan->ras) == 2 ? 'selected' : '' }}>Unggas</option>
                    <option value="3" {{ old('ras', $hewan->ras) == 3 ? 'selected' : '' }}>Reptil</option>
                </select>
                @error('ras')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="text" class="form-control @error('umur') is-invalid @enderror"
                    id="umur" name="umur" value="{{ old('umur', $hewan->umur) }}"
                    required>
                @error('umur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pemilik_id">Pemilik</label>
                <select class="form-control @error('pemilik_id') is-invalid @enderror" name="pemilik_id"
                    id="pemilik_id" required>
                    <option value="" disabled>-- Pilih Pemilik --</option>
                    @foreach ($pemiliks as $pemilik)
                        <option value="{{ $pemilik->id }}"
                            {{ old('pemilik_id', $hewan->pemilik_id) == $pemilik->id ? 'selected' : '' }}>
                            {{ $pemilik->nama }}
                        </option>
                    @endforeach
                </select>
                @error('pemilik_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if ($hewan->image)
                    <img src="{{ Storage::url($hewan->image) }}" alt="{{ $hewan->nama }}" width="100" class="mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
