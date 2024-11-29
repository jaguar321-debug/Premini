<div x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col"> <!-- Changed from justify-between h-16 to flex-col -->
            <div class="flex items-center mb-4"> <!-- Added mb-4 for spacing -->
                <!-- Logo -->
                <div class="shrink-0 flex items-center mt-2 mr-2">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Nama Dokter Hewan -->
                <span class="mt-3 text-lg font-semibold text-gray-800">
                    Dokter Hewan
                </span>
            </div>
            <hr class="border-gray-300 mb-3">
            <!-- Navigation Links -->
            <nav class="flex-1 px-6 mt-2"> <!-- Removed mt-6 and adjusted to mt-2 -->
                <ul class="space-y-6">
                    <li>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('pemiliks.index')" :active="request()->routeIs('pemiliks.*')">
                            {{ __('Pemilik') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('hewans.index')" :active="request()->routeIs('hewans.*')">
                            {{ __('Hewan') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('dokters.index')" :active="request()->routeIs('dokters.*')">
                            {{ __('Dokter') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('jadwals.index')" :active="request()->routeIs('jadwals.*')">
                            {{ __('Jadwal') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('pemeriksaans.index')" :active="request()->routeIs('pemeriksaans.*')">
                            {{ __('Pemeriksaan') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('pemeriksaans.riwayat')" :active="request()->routeIs('pemeriksaans.riwayat')">
                            {{ __('Riwayat') }}
                        </x-nav-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
