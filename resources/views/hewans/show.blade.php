<x-app-layout>
    <div class="container mt-4">
        <h1 class="mb-4">Detail Hewan</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ $hewan->nama }}
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        @if ($hewan->image)
                            <img src="{{ Storage::url($hewan->image) }}" alt="{{ $hewan->nama }}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                        @else
                            <p class="text-muted">Gambar tidak tersedia</p>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <td>Jenis</td>
                                <td>: {{ $hewan->jenis }}</td>
                            </tr>
                            <tr>
                                <td>Ras</td>
                                <td>: {{ $hewan->ras }}</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>: {{ $hewan->umur }} Bulan</td>
                            </tr>
                            <tr>
                                <td>Pemilik</td>
                                <td>: {{ $hewan->pemilik->nama }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <a href="{{ route('hewans.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Hewan</a>
            </div>
        </div>
    </div>
</x-app-layout>
