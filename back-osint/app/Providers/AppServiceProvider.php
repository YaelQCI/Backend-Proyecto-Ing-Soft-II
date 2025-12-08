<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\CategoriaHerramienta;
use App\Herramienta;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('http');
        }

        // Compartir categorías y herramientas con el layout dashboard
        View::composer('layouts.dashboard', function ($view) {
            $view->with('categorias', CategoriaHerramienta::all());
            $view->with('herramientas', Herramienta::all());
        });
    }
}
