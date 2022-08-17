<?php

namespace Application\Offers\Providers;

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
        view()->composer('Offers::offers.form','Application\Offers\Http\Composers\OffersComposer');

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
