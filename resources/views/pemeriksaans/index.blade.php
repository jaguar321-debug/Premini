<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemeriksaan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('pemeriksaans.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <form action="{{ route('pemeriksaans.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Perawatan..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($pemeriksaans->isEmpty())
            <div class="alert alert-warning mt-3" role="alert">
                Data tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th>Tanggal Perawatan</th>
                        <th>Jenis Perawatan</th>
                        <th>Vaksin</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Actions</th>
                    </tr>
                </thead>    
                <tbody>
                    @foreach ($pemeriksaans as $index => $pemeriksaan)
                        <tr>
                            <td>{{ $pemeriksaan->id }}</td>
                            <td>{{ $pemeriksaan->hewan->nama }}</td>
                            <td>Dr. {{ $pemeriksaan->dokter->nama }}</td>
                            <td>{{ $pemeriksaan->jadwal->tanggal_pemeriksaan }}</td>
                            <td>
                                @switch($pemeriksaan->jenis_perawatan)
                                    @case('1')
                                        Grooming
                                        @break
                                    @case('2')
                                        Bersihkan Kandang Hewan
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $pemeriksaan->vaksin ? 'Ya' : 'Tidak' }}</td> <!-- Mengonversi nilai vaksin -->
                            <td>{{ 'Rp ' . number_format($pemeriksaan->harga, 0, ',', '.') }}</td>
                            <td>{{ $pemeriksaan->deskripsi }}</td>
                            <td>
                                <a href="{{ route('pemeriksaans.edit', $pemeriksaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="{{ route('pemeriksaans.pindahKeRiwayat', $pemeriksaan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Kamu Yakin Ingin Kirim Data?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Riwayat</button>
                                </form>

                                <form action="{{ route('pemeriksaans.destroy', $pemeriksaan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Kamu Yakin Ingin Hapus Data?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
