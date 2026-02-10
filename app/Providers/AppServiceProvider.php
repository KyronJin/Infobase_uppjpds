<?php

namespace App\Providers;

use App\Models\Pengumuman;
use Illuminate\Support\ServiceProvider;

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
        // Set locale based on session or default to 'id' (Indonesian)
        $locale = session('locale', 'id');
        app()->setLocale($locale);

        // Otomatis update status pengumuman yang sudah expired setiap kali app diboot
        if (app()->runningInConsole() === false) {
            try {
                Pengumuman::updateExpiredStatus();
            } catch (\Exception $e) {
                // Silent fail jika database belum ready
            }
        }
    }
}
