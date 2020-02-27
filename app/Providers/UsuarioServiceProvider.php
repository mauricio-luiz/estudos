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
        $this->app->bind("App\Domain\Usuarios\UsuarioAdpterInterface", function(){
            return new \App\Domain\Usuarios\Usuario(new \App\Models\User());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [\App\Domain\Usuarios\Usuario::class];
    }
}
