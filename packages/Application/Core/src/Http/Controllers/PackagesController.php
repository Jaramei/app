<?php

namespace Application\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Application\Core\Repositories\Packages\Interfaces\PackageInterface;
use Application\Core\Http\Requests\PackageRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Process;
use Application\Core\Repositories\PackagesTranslations\Interfaces\PackageTranslationsInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PackagesController extends Controller
{

    protected $package;
    protected $composer;
    protected $files;
    protected $translation;

    public function __construct(PackageInterface $package,PackageTranslationsInterface $translation,Filesystem $files,Composer $composer)

    {
        $this->composer = $composer;
        $this->package = $package;
        $this->translation = $translation;
        $this->files = $files;

    }

    public function index() {

       return view('core::packages.index')->with('model',null)->with('data',$this->package->all());

    }

    public function store(PackageRequest $request) {


        if($request->has('createFiles')) {

            Artisan::call('package:create',['name'=>$request->name]);

        } else {

            Artisan::call('package:activate',['name'=>$request->name]);

        }

        if(!$request->has('status')) {
            $request->merge(['status'=>0]);
        }

        $this->composer->dumpAutoloads();

        Session::forget('packages');

        $primary = $this->package->create($request->except('_token','languages'));

        $this->updateOrCreateTranslation($primary->id,$request);

        return back()->with('success', 'The record was created');

    }

    public function edit($id) {


       return view('core::packages.edit')
        ->with('data',$this->package->all())
        ->with('translations',$this->translation->getByColumn('package_id',$id,['lang_id','name'])->pluck('name','lang_id')->toArray())
        ->with('model',$this->package->getById($id));

    }

    public function update(PackageRequest $request, $id)
    {

        $this->updateOrCreateTranslation($request->package_id,$request);

        if(!$request->has('status')) {

            $request->merge(['status'=>0]);

        }

        $this->composer->dumpAutoloads();

        Artisan::call('cache:clear');

        $this->package->update($request->except('_token','_method','languages','package_id'),$id);

        Session::forget('packages');

        return back()->with('success', 'The record was updated');

    }

    public function destroy($id) {

        Artisan::call('package:remove',['name'=>$this->package->getById($id)->name,'--no-interaction']);

        Schema::drop($this->package->getById($id)->name);

        Session::forget('packages');

        $this->package->destroy($id);

        return redirect()->route('packages.index')->with('success', 'The package was deleted')->with('success-file','Files have been deleted!');
    }


    private function updateOrCreateTranslation($primary,$request) {

                foreach($request->languages as $key=>$value) {

                        if($value) {

                            $this->translation->updateOrCreate(['package_id' => $primary, 'lang_id' => $key],
                                ['package_id' => $primary,
                                    'lang_id' => $key,
                                    'name' => $value,
                                    'slug' => 'route.'.Str::slug($request->languages[2]),
                                    'route' => 1
                                ]);

                        } else {

                            $this->translation->where('package_id',$primary)->where('lang_id',$key)->delete();

                        }

                }

    }


}