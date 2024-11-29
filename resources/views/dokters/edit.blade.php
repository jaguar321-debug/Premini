<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dokter') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('dokters.update', $dokter->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $dokter->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="spesialis">Spesialis</label>
                <select class="form-control @error('spesialis') is-invalid @enderror" id="spesialis" name="spesialis" required>
                    <option disabled>-- Pilih Spesialis --</option>
                    <option value="1" {{ old('spesialis', $dokter->spesialis_id) == 1 ? 'selected' : '' }}>Mata</option>
                    <option value="2" {{ old('spesialis', $dokter->spesialis_id) == 2 ? 'selected' : '' }}>Kulit</option>
                    <option value="3" {{ old('spesialis', $dokter->spesialis_id) == 3 ? 'selected' : '' }}>Pencernaan</option>
                    <option value="4" {{ old('spesialis', $dokter->spesialis_id) == 4 ? 'selected' : '' }}>Gigi</option>
                    <option value="5" {{ old('spesialis', $dokter->spesialis_id) == 5 ? 'selected' : '' }}>Bulu</option>
                </select>
                @error('spesialis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nomor_telepon">No Telp</label>
                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $dokter->nomor_telepon) }}" required>
                @error('nomor_telepon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="gmail">Email</label>
                <input type="gmail" class="form-control @error('gmail') is-invalid @enderror" id="gmail" name="gmail" value="{{ old('gmail', $dokter->gmail) }}" required>
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
