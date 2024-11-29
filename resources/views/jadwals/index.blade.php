<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Jadwal Pemeriksaan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('jadwals.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <form action="{{ route('jadwals.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Jadwal..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($jadwals->isEmpty())
            <div class="alert alert-warning mt-3" role="alert">
                Data tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pemeriksaan</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th>Waktu Pemeriksaan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $index => $jadwal)
                        <tr>
                            <td>{{ $jadwal->id }}</td>
                            <td>{{ $jadwal->tanggal_pemeriksaan }}</td> 
                            <td>{{ $jadwal->hewan->nama }}</td>
                            <td>Dr. {{ $jadwal->dokter->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->waktu_pemeriksaan)->format('H:i') }}</td>

                            <td>
                                <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Apakah Kamu Yakin Ingin Hapus Data?');">
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
