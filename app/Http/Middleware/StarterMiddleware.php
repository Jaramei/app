<?php namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;
use Session;

class StarterMiddleware
{

    private $collection;
    private $languages;

    public function __construct(Collection $collection,LanguageInterface $languages){

        $this->collection = $collection;
        $this->languages = $languages;

    }

    public function handle($request, Closure $next)
    {


            Session::put('bootstrap',$this->buildCollection($request));




        return $next($request);

    }

    private function buildCollection($request) {


        return $this->collection->make([
            'locale_id'=> $this->languages->getLocale($request->segment(1),'id'),
            'locale_name'=>$this->languages->getLocale($request->segment(1),'name'),
            'slug'=>$this->languages->getLocale($request->segment(1),'slug'),
            'languages'=>$this->languages->all(['slug', 'id','name'])->toArray()

        ]);

    }




}