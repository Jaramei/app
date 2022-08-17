<?php

namespace Application\Offers\Providers;

use Application\Offers\Models\Offers;
use Illuminate\Support\ServiceProvider;
use Application\Offers\Repositories\Caches\OffersCacheDecorator;
use Application\Offers\Repositories\Eloquent\OffersRepository;
use Application\Offers\Repositories\Interfaces\OffersInterface;
use Application\Core\Supports\Helper;

class OffersServiceProvider extends ServiceProvider
{


    public function register()
    {
        if (config('enable_cache', false)) {
            $this->app->singleton(OffersInterface::class, function () {
                return new OffersCacheDecorator(new OffersRepository(new Offers()), new Cache($this->app['cache'], OffersRepository::class));
            });
        } else {
            $this->app->singleton(OffersInterface::class, function () {
                return new OffersRepository(new Offers());
            });
        }

        Helper::autoload(__DIR__ . '/../../helpers');

          $this->app->register('\Application\Offers\Providers\ComposersServiceProvider');

    }


    public function boot()
    {

         $this->app->router->group(['namespace'=>'Application\Offers\Http\Controllers'], function() {

                    $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

          });

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Offers');
        $this->mergeConfigFrom(__DIR__ . '/../../config/offers.php', 'Offers');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Offers');

        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Offers')], 'views');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Offers')], 'lang');
            $this->publishes([__DIR__ . '/../../config/Offers.php' => config_path('Offers.php')], 'config');
        }
    }
}
