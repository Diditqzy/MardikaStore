<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\View\Components\PublicLayout;
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
        
        Blade::component('public-layout', PublicLayout::class);
    }
}
