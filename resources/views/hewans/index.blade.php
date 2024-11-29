<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hewan Peliharaan') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('hewans.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <form action="{{ route('hewans.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Hewan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($hewans->isEmpty())
            <div class="alert alert-warning mt-3" role="alert">
                Data tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Umur</th>
                        <th>Pemilik</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hewans as $index => $hewan)
                        <tr>
                            <td>{{ $hewan->id }}</td>
                            <td>{{ $hewan->nama }}</td>
                            <td>{{ $hewan->jenis }}</td>
                            <td>{{ $hewan->ras }}</td>
                            <td>{{ $hewan->umur }} Bulan</td>
                            <td>{{ $hewan->pemilik->nama }}</td>
                            <td>
                                <a href="{{ route('hewans.show', $hewan->id) }}" class="btn btn-info btn-sm">Show</a>
                                <a href="{{ route('hewans.edit', $hewan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('hewans.destroy', $hewan->id) }}" method="POST"
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
