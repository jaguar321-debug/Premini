<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Hewan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('hewans.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                    <option selected disabled>-- Pilih Jenis --</option>
                    <option value="1" {{ old('jenis') == 1 ? 'selected' : '' }}>Kucing</option>
                    <option value="2" {{ old('jenis') == 2 ? 'selected' : '' }}>Bunglon</option>
                    <option value="3" {{ old('jenis') == 3 ? 'selected' : '' }}>Anjing</option>
                    <option value="4" {{ old('jenis') == 4 ? 'selected' : '' }}>Kura-Kura</option>
                    <option value="5" {{ old('jenis') == 5 ? 'selected' : '' }}>Merpati</option>
                </select>
                @error('jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ras">Ras</label>
                <select class="form-control @error('ras') is-invalid @enderror" id="ras" name="ras">
                    <option selected disabled>-- Pilih Ras --</option>
                    <option value="1" {{ old('ras') == 1 ? 'selected' : '' }}>Mamalia</option>
                    <option value="2" {{ old('ras') == 2 ? 'selected' : '' }}>Unggas</option>
                    <option value="3" {{ old('ras') == 3 ? 'selected' : '' }}>Reptil</option>
                </select>
                @error('ras')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="umur">Umur</label>
                <input type="text" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('umur') }}">
                @error('umur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pemilik_id">Pemilik</label>
                <select class="form-control @error('pemilik_id') is-invalid @enderror" name="pemilik_id" id="pemilik_id">
                    <option disabled selected>-- Pilih Pemilik --</option>
                    @foreach ($pemiliks as $pemilik)
                        <option value="{{ $pemilik->id }}" {{ old('pemilik_id') == $pemilik->id ? 'selected' : '' }}>
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
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
