<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Para evitar error en las migraciones:
use Illuminate\Support\Facades\Schema;

// Para la paginación: 
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Para evitar error en las migraciones
        Schema::defaultStringLength(191);

        // Paginación:
        Paginator::useBootstrap();
    }
}
