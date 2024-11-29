<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokter') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('dokters.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <form action="{{ route('dokters.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Dokter..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($dokters->isEmpty())
            <div class="alert alert-warning mt-3" role="alert">
                Data tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dokters as $index => $dokter)
                        <tr>
                            <td>{{ $dokter->id }}</td>
                            <td>Dr. {{ $dokter->nama }}</td>
                            <td>{{ $dokter->spesialis }}</td>
                            <td>{{ $dokter->nomor_telepon }}</td>
                            <td>{{ $dokter->gmail }}</td>
                            <td>
                                <a href="{{ route('dokters.edit', $dokter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('dokters.destroy', $dokter->id) }}" method="POST"
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
