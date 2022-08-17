<?php

namespace App\Http\Middleware;

use Illuminate\Support\Collection;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;
use Session;
use Closure;
use Config;

class LocaleMiddleware
{

    private $collection;
    private $languages;

    public function __construct(Collection $collection,LanguageInterface $languages){

        $this->collection = $collection;
        $this->languages = $languages;

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {


        if (!Session::get('bootstrap')) {

            Session::put('bootstrap',$this->buildCollection(config('app.locale')));

        }

        if (Session::get('bootstrap')->get('slug') != $request->segment(1)) {

            if ($request->method() === 'GET') {

                $segment = $request->segment(1);

                if (!in_array($segment, $this->languages->all()->pluck('slug')->toArray())) {

                    $segments = $request->segments();
                    $fallback = url('/') ? config('app.locale'):
                    $fallback = session('locale') ?: config('app.fallback_locale');
                    $segments = array_prepend($segments, $fallback);

                    return redirect()->to(implode('/', $segments));

                }

                Session::put('bootstrap', $this->buildCollection($request->segment(1)));

            }

        }

        app()->setLocale(Session::get('bootstrap')->get('slug'));

        return $next($request);
    }


    private function buildCollection($request) {

        $lang = $this->languages->getLocale($request);

        return $this->collection->make([
            'locale_id'=> $lang->id,
            'locale_name'=>$lang->name,
            'slug'=>$lang->slug,
            'languages'=>$this->languages->all(['slug', 'id','name'])->toArray()

        ]);

    }

}