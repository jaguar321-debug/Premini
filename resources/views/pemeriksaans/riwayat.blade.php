<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat') }}
        </h2>
    </x-slot>
    <div class="container mt-4">
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
                    <th>Status</th> <!-- Kolom Status -->
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->hewan->nama }}</td>
                        <td>Dr. {{ $riwayat->dokter->nama }}</td>
                        <td>{{ $riwayat->jadwal->tanggal_pemeriksaan }}</td>
                        <td>{{ $riwayat->jenis_perawatan }}</td>
                        <td>{{ $riwayat->vaksin ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ 'Rp ' . number_format($riwayat->harga, 0, ',', '.') }}</td>
                        <td>{{ $riwayat->deskripsi }}</td>
                        <td>Sedang Diperiksa</td> <!-- Menampilkan Status -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
