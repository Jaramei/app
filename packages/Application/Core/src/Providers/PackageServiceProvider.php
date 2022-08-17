<?php

namespace Application\Core\Providers;

use Application\Core\Repositories\Packages\Interfaces\PackageInterface;
use Application\Core\Repositories\PackagesTranslations\Interfaces\PackageTranslationsInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Artisan;
use Route;

class PackageServiceProvider extends ServiceProvider
{

    public function boot()
    {

        if (check_database_connection() && Schema::hasTable('packages')) {
            $packages = app(PackageInterface::class)->getByColumn('status',1);
            if(!Session::has('packages')) {
                Session::put('packages',$packages);

            }

            if ($packages instanceof Collection && !empty($packages)) {

                foreach ($packages as $package) {
                    if (class_exists($package->provider)) {
                        $this->app->register($package->provider);
                    }
                }
            }

            Route::group(['namespace' => 'App\Http\Controllers','middleware' => ['web','frontend','locale']], function() {

             $routes = app(PackageTranslationsInterface::class)->getByColumn('route',1);

             foreach($routes as $route) {

                 Route::get($route->lang->slug.'/'.$route->name,['as'=>$route->slug,'uses'=>$route->package->controller.'Controller@index']);
                 Route::get($route->lang->slug.'/'.$route->name.'{param}/edit',['as'=>$route->slug,'uses'=>$route->package->controller.'Controller@edit']);
                 Route::get($route->lang->slug.'/'.$route->name.'/{slug}',['as'=>$route->slug,'uses'=>$route->package->controller.'Controller@show'])->where('slug', '[A-Za-z]+');
                 Route::get($route->lang->slug.'/'.$route->name.'/{slug}/{param}',['as'=>$route->slug,'uses'=>$route->package->controller.'Controller@get'])->where('slug|param', '[A-Za-z]+');

             }

        });

        }
    }

}
