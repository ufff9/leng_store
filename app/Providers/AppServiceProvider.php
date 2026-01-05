<?php

namespace App\Providers;

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
    // Pastikan pengecekan env benar
    if (config('app.env') !== 'local') {
        $path = '/tmp/storage/framework/views';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        // Pastikan ini tidak menyebabkan error binding
        config(['view.compiled' => $path]);
    }
}
}
