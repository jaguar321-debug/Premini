<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('pemeriksaans.update', $pemeriksaan->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="hewan_id">Hewan</label>
                <select class="form-control @error('hewan_id') is-invalid @enderror" name="hewan_id"
                    id="hewan_id" required>
                    <option value="" disabled>-- Tanggal --</option>
                    @foreach ($hewans as $hewan)
                        <option value="{{ $hewan->id }}"
                            {{ old('hewan_id', $pemeriksaan->hewan_id) == $hewan->id ? 'selected' : '' }}>
                            {{ $hewan->nama }}
                        </option>
                    @endforeach
                </select>
                @error('hewan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="dokter_id">Dokter</label>
                <select class="form-control @error('dokter_id') is-invalid @enderror" name="dokter_id"
                    id="dokter_id" required>
                    <option value="" disabled>-- Tanggal --</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}"
                            {{ old('dokter_id', $pemeriksaan->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_pemeriksaan_id">Tanggal Perawatan</label>
                <select class="form-control @error('tanggal_pemeriksaan_id') is-invalid @enderror" name="tanggal_pemeriksaan_id"
                    id="tanggal_pemeriksaan_id" required>
                    <option value="" disabled>-- Tanggal --</option>
                    @foreach ($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}"
                            {{ old('tanggal_pemeriksaan_id', $pemeriksaan->tanggal_pemeriksaan_id) == $jadwal->id ? 'selected' : '' }}>
                            {{ $jadwal->tanggal_pemeriksaan }}
                        </option>
                    @endforeach
                </select>
                @error('tanggal_pemeriksaan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jenis_perawatan">Jenis Perawatan</label>
                <select class="form-control @error('jenis_perawatan') is-invalid @enderror" id="jenis_perawatan"
                name="jenis_perawatan" required>
                <option value="" disabled>-- Pilih Jenis Perawatan --</option>
                <option value="1" {{ old('jenis_perawatan', $pemeriksaan->jenis_perawatan_id) == 1 ? 'selected' : '' }}>Grooming</option>
                <option value="2" {{ old('jenis_perawatan', $pemeriksaan->jenis_perawatan_id) == 2 ? 'selected' : '' }}>Bersihkan tempat Kotoran Hewan</option>
            </select>
                @error('jenis_perawatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="vaksin">Vaksin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('vaksin') is-invalid @enderror" type="radio" id="vaksin_yes" name="vaksin" value="1" {{ old('vaksin', $pemeriksaan->vaksin) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="vaksin_yes">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('vaksin') is-invalid @enderror" type="radio" id="vaksin_no" name="vaksin" value="0" {{ old('vaksin', $pemeriksaan->vaksin) == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="vaksin_no">Tidak</label>
                </div>
                @error('vaksin')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $pemeriksaan->harga) }}">
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> 
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                    name="deskripsi">{{ old('deskripsi', $pemeriksaan->deskripsi) }}</textarea> 
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
