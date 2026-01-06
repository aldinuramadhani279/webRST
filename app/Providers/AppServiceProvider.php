<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Membuat directive blade untuk helper gambar
        Blade::directive('imagePath', function ($expression) {
            return "<?php echo \\App\\Helpers\\ImageHelper::getImagePath($expression); ?>";
        });
    }
}
