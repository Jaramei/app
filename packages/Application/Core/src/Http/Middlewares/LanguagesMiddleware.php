<?php

namespace Application\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Application;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;
use Config;


class LanguagesMiddleware  {

    public function __construct(Application $app, LanguageInterface $language) {

        $this->app = $app;
        $this->language = $language;
    }


    public function handle(Request $request, Closure $next)
    {

        if (Session::has('locale')) {

            $this->app->setLocale(Session::get('locale'));

            Session::put('locale-id',$this->language->getLocale(Session::get('locale')));

        } else {

            Session::put('locale-id',config()->get('core.locale-id'));

        }

        return $next($request);
    }


}