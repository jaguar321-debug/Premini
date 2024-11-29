<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('duplicate_email', function ($attribute, $value, $parameters, $validator) {
            $ignoreId = $parameters[0] ?? null; // Ambil parameter pertama (ID yang diabaikan) jika ada

            $pemilikQuery = \App\Models\Pemilik::where('gmail', $value);
            $dokterQuery = \App\Models\Dokter::where('gmail', $value);

            if ($ignoreId) {
                $pemilikQuery->where('id', '!=', $ignoreId);
                $dokterQuery->where('id', '!=', $ignoreId);
            }

            $pemilikExists = $pemilikQuery->exists();
            $dokterExists = $dokterQuery->exists();

            return !$pemilikExists && !$dokterExists;
        });

        Validator::extend('duplicate_nomor_telepon', function ($attribute, $value, $parameters, $validator) {
            $ignoreId = $parameters[0] ?? null; // Ambil parameter pertama (ID yang diabaikan) jika ada

            $pemilikQuery = \App\Models\Pemilik::where('nomor_telepon', $value);
            $dokterQuery = \App\Models\Dokter::where('nomor_telepon', $value);

            if ($ignoreId) {
                $pemilikQuery->where('id', '!=', $ignoreId);
                $dokterQuery->where('id', '!=', $ignoreId);
            }

            $pemilikExists = $pemilikQuery->exists();
            $dokterExists = $dokterQuery->exists();

            return !$pemilikExists && !$dokterExists;
        });
    }
}
