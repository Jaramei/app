<?php

namespace Application\Core\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class ComposersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*','Application\Core\Http\Composers\CoreComposer');
        view()->composer('*','Application\Core\Http\Composers\LanguagesComposer');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()

    {

    }
}
