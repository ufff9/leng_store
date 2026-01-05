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
    // Tambahkan kode ini agar Vercel bisa menulis file cache view
    if (config('app.env') !== 'local') {
        $path = '/tmp/storage/framework/views';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        config(['view.compiled' => $path]);
    }
}
}
