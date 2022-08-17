<?php

namespace Application\Products\Providers;

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
        view()->composer('*','Application\Products\Http\Composers\ProductsComposer');

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
