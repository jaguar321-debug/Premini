<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pemilik') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
        <div class="d-flex justify-content-between">
            <a href="{{ route('pemiliks.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <form action="{{ route('pemiliks.index') }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari Pemilik..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($pemiliks->isEmpty())
            <div class="alert alert-warning mt-3" role="alert">
                Data tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemiliks as $index => $pemilik)
                        <tr>
                            <td>{{ $pemilik->id }}</td>
                            <td>{{ $pemilik->nama }}</td>
                            <td>Jl. {{ $pemilik->alamat }}</td>
                            <td>{{ $pemilik->nomor_telepon }}</td>
                            <td>{{ $pemilik->gmail }}</td>
                            <td>
                                <a href="{{ route('pemiliks.edit', $pemilik->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pemiliks.destroy', $pemilik->id) }}" method="POST"
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
