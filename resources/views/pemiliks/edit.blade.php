<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pemilik') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('pemiliks.update', $pemilik->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>  
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $pemilik->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>  
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $pemilik->alamat) }}" required>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nomor_telepon">No Telp</label>  
                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $pemilik->nomor_telepon) }}" required>
                @error('nomor_telepon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gmail">Email</label>  
                <input type="text" class="form-control @error('gmail') is-invalid @enderror" id="gmail" name="gmail" value="{{ old('gmail', $pemilik->gmail) }}" required>
                @error('gmail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
