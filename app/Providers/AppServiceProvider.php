<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// For Pagination 
use Illuminate\Pagination\Paginator;

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
        // Allowing Customization For Paginate Links
        Paginator::useBootstrap();
    }
}
