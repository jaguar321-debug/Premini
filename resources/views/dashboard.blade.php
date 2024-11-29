<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- Grid untuk menata card -->
    <div class="container">
        <div class="row justify-content-center">
            <!-- Card untuk jumlah hewan -->
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="{{ route('hewans.index') }}">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-center text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah Hewan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahHewan }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-paw fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card untuk jumlah dokter -->
            <div class="col-xl-6 col-md-6 mb-4">
                <a href="{{ route('dokters.index') }}">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-center text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Dokter
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahDokter }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-md fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
