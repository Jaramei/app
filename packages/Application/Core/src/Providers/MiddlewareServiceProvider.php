<?php namespace Application\Core\Providers;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * All of the short-hand keys for middlewares.
     *
     * @var array
     */
    protected $middleware = [
        'role'=>         '\Application\Core\Http\Middlewares\RolesMiddleware::class',
        'language'=>      '\Application\Core\Http\Middlewares\LanguagesMiddleware::class'
    ];

    /**
     * Bootstrap any application services.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        parent::boot();

        foreach($this->middleware as $name => $class) {
            $this->aliasMiddleware($name, $class);
        }
    }

}