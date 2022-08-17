<?php

namespace Application\Core\Providers;


use Illuminate\Support\ServiceProvider;
use Application\Core\Supports\Helper;
use Illuminate\Support\Facades\Schema;
use Application\Core\Repositories\Users\Eloquent\UserRepositories;
use Application\Core\Repositories\Users\Interfaces\UserInterface;

use Application\Core\Repositories\RepositoryInterface;
use Application\Core\Repositories\RepositoryEloquent;

use Application\Core\Repositories\Roles\Eloquent\RoleRepositories;
use Application\Core\Repositories\Roles\Interfaces\RoleInterface;
use Application\Core\Repositories\Languages\Eloquent\LanguageRepository;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;
use Application\Core\Repositories\Packages\Eloquent\PackageRepositories;
use Application\Core\Repositories\Packages\Interfaces\PackageInterface;
use Application\Core\Repositories\PackagesTranslations\Eloquent\PackageTranslationsRepositories;
use Application\Core\Repositories\PackagesTranslations\Interfaces\PackageTranslationsInterface;


use App\User;
use Application\Core\Models\Languages;
use Application\Core\Models\Users\Roles;
use Application\Core\Models\Packages;
use Application\Core\Models\Packages\Translations;
use Application\Core\Services\Crud;

class CoreServiceProvider extends ServiceProvider
{


    public function register()
    {

            $this->app->singleton(UserInterface::class, function () {
                return new UserRepositories(new User());
            });

            $this->app->singleton(PackageInterface::class, function () {
                return new PackageRepositories(new Packages());
            });

            $this->app->singleton(PackageTranslationsInterface::class, function () {
                return new PackageTranslationsRepositories(new Translations());
            });

            $this->app->singleton(RoleInterface::class, function () {
                return new RoleRepositories(new Roles());
            });

            $this->app->singleton(LanguageInterface::class,function(){

                return new LanguageRepository(new Languages());

            });


          Schema::defaultStringLength(191);

          $this->app->register('\Application\Core\Providers\ComposersServiceProvider');
          $this->app->register('\Application\Core\Providers\CommandsServiceProvider');
          $this->app->register('\Application\Core\Providers\MiddlewareServiceProvider');
          $this->app->register('\Application\Core\Providers\PackageServiceProvider');

          Helper::autoload(__DIR__ . '/../../helpers');

         $this->app->bind('Crud', Crud::class);





    }


    public function boot()
    {

         $this->app->router->group(['namespace'=>'Application\Core\Http\Controllers'], function() {

                    $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

          });

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'core');
        $this->mergeConfigFrom(__DIR__ . '/../../config/core.php', 'core');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'core');

        if (app()->runningInConsole()) {

            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
            $this->publishes([__DIR__ . '/../../publishable/assets/css'=>public_path('css/packages/core')]);
            $this->publishes([__DIR__ . '/../../publishable/assets/js'=>public_path('js/packages/core')]);
            $this->publishes([__DIR__ . '/../../publishable/assets/img'=>public_path('/img')]);
            $this->publishes([__DIR__ . '/../../publishable/assets/fonts'=>public_path('/fonts')]);
        }

        if ($this->app->environment() == 'local') {
            if (env('ENABLE_DEBUG_BAR') == true) {
                $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            }
        }


    }
}
