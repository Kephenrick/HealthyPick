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
        // Register middleware to set locale from session on each request
        // This ensures session is available when we set the application locale
        $router = $this->app->make(\Illuminate\Routing\Router::class);
        $router->pushMiddlewareToGroup('web', \App\Http\Middleware\SetLocale::class);
    }
}
