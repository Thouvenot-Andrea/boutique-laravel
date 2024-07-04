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
        Blade::directive('wishlisted', function ($expression) {
            return "<?php if (auth()->check() && auth()->user()->hasWishlisted({$expression})): ?>";
        });

        Blade::directive('endwishlisted', function () {
            return '<?php endif; ?>';
        });
    }
}
