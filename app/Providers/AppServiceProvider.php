<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // <-- WAJIB IMPORT INI
use Illuminate\Support\Facades\URL;

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
        // Solusi untuk limit indeks skema database pada PostgreSQL / MySQL lama
        Schema::defaultStringLength(191);

        // Paksa HTTPS jika di lingkungan production atau deployment Vercel
        if (config('app.env') === 'production' || getenv('VERCEL') || isset($_SERVER['VERCEL'])) {
            URL::forceScheme('https');
        }
    }
}