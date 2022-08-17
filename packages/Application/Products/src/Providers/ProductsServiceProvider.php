<?php

namespace Application\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Application\Core\Supports\Helper;

use Application\Products\Models\Products;
use Application\Products\Models\ProductCategories;

use Application\Products\Repositories\ProductsRepository;
use Application\Products\Repositories\ProductsInterface;

use Application\Products\Repositories\ProductCategories\ProductCategoriesRepository;
use Application\Products\Repositories\ProductCategories\ProductCategoriesInterface;


class ProductsServiceProvider extends ServiceProvider
{


    public function register()
    {

        $this->app->singleton(ProductsInterface::class, function () {
                return new ProductsRepository(new Products());
        });

        $this->app->singleton(ProductCategoriesInterface::class, function () {
            return new ProductCategoriesRepository(new ProductCategories());
        });


        Helper::autoload(__DIR__ . '/../../helpers');

          $this->app->register('\Application\Products\Providers\ComposersServiceProvider');

    }


    public function boot()
    {



         $this->app->router->group(['namespace'=>'Application\Products\Http\Controllers'], function() {

                    $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

          });

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'Products');
        $this->mergeConfigFrom(__DIR__ . '/../../config/products.php', 'Products');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'Products');

        if (app()->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/Products')], 'views');
            $this->publishes([__DIR__ . '/../../resources/lang' => resource_path('lang/vendor/Products')], 'lang');
            $this->publishes([__DIR__ . '/../../config/Products.php' => config_path('Products.php')], 'config');
        }
    }



}
