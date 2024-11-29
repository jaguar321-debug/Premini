<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <form method="POST" action="{{ route('jadwals.update', $jadwal->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tanggal_pemeriksaan">Tanggal Pemeriksaan</label>
                <input type="date" class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                id="tanggal_pemeriksaan" name="tanggal_pemeriksaan" value="{{ old('tanggal_pemeriksaan', $jadwal->tanggal_pemeriksaan) }}"
                required>
                @error('tanggal_pemeriksaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hewan_id">Hewan</label>
                <select class="form-control @error('hewan_id') is-invalid @enderror" name="hewan_id"
                    id="hewan_id" required>
                    <option value="" disabled>-- Pilih Pemilik --</option>
                    @foreach ($hewans as $hewan)
                        <option value="{{ $hewan->id }}"
                            {{ old('hewan_id', $jadwal->hewan_id) == $hewan->id ? 'selected' : '' }}>
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
                    <option value="" disabled>-- Pilih Pemilik --</option>
                    @foreach ($dokters as $dokter)
                        <option value="{{ $dokter->id }}"
                            {{ old('dokter_id', $jadwal->dokter_id) == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->nama }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="waktu_pemeriksaan">Tanggal Pemeriksaan</label>
                <input type="time" class="form-control @error('waktu_pemeriksaan') is-invalid @enderror"
                id="waktu_pemeriksaan" name="waktu_pemeriksaan" value="{{ old('waktu_pemeriksaan', $jadwal->waktu_pemeriksaan) }}"
                required>
                @error('waktu_pemeriksaan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
