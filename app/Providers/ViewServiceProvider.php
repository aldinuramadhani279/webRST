<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $settings = cache()->rememberForever('settings', function () {
                return \App\Models\Setting::all()->pluck('value', 'key');
            });
            
            \Illuminate\Support\Facades\View::share('settings', $settings);
        } catch (\Exception $e) {
            // This is to prevent errors during initial migrations when the settings table might not exist yet.
            \Illuminate\Support\Facades\View::share('settings', []);
        }
    }
}
