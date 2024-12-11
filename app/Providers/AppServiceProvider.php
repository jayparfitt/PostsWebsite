<?php

namespace App\Providers;

use App\Services\OpenLibraryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     */
    public function register(): void
    {
        // Binds the OpenLibraryService to the service container
        $this->app->singleton(OpenLibraryService::class, function ($app) {
            return new OpenLibraryService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
