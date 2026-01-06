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
                $allSettings = \App\Models\Setting::all()->pluck('value', 'key');
                
                // Decode JSON fields
                $jsonFields = ['partner_logos', 'emergency_numbers'];
                foreach ($jsonFields as $field) {
                    if (isset($allSettings[$field])) {
                        $decoded = json_decode($allSettings[$field], true);
                        $allSettings[$field] = is_array($decoded) ? $decoded : [];
                    }
                }
                
                return $allSettings;
            });
            
            \Illuminate\Support\Facades\View::share('settings', $settings);
        } catch (\Exception $e) {
            // This is to prevent errors during initial migrations when the settings table might not exist yet.
            \Illuminate\Support\Facades\View::share('settings', []);
        }
    }
}
