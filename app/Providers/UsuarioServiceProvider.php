<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UsuarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Dominios\Usuarios\UsuarioAdaptadorInterface", function(){
            return new \App\Dominios\Usuarios\Usuario(new \App\Models\User());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [\App\Dominios\Usuarios\Usuario::class];
    }
}
