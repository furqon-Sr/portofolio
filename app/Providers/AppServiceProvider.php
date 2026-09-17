<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // <-- WAJIB IMPORT INI
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

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

        // Global shared site settings (fetched once per request, scoped to request lifecycle)
        View::composer('*', function ($view) {
            if (!app()->has('siteSettingInstance')) {
                try {
                    $setting = \App\Models\AboutSetting::first() ?? new \App\Models\AboutSetting([
                        'logo_type' => 'text',
                        'logo_value' => 'HANAFI',
                        'footer_name' => 'FAHRURI HANAFI',
                        'footer_copyright' => '© 2026 Fahruri Hanafi. All rights reserved.',
                        'hero_title' => 'Bridging the gap between optical balance and scalable architecture.',
                        'hero_subtitle' => 'Product Designer & Fullstack Dev.'
                    ]);
                } catch (\Throwable $e) {
                    $setting = new \App\Models\AboutSetting();
                }
                app()->instance('siteSettingInstance', $setting);
            } else {
                $setting = app('siteSettingInstance');
            }
            $view->with('siteSetting', $setting);
            $view->with('siteSettingsData', $setting);
        });
    }
}