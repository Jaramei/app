<?php namespace Application\Core\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
use Application\Core\Services\Crud;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;
use Application\Core\Http\Requests\LangaugeRequest;


class LanguagesController extends BaseController
{

    protected $crud;
    protected $model;

    function __construct(LanguageInterface $model, Crud $crud)
    {

        $this->model = $model;
        $this->crud = $crud;

    }


    public function index() {

        return view('core::languages.index')->with('data',$this->model->all());

    }

    public function store(LangaugeRequest $request) {

        if(!$request->has('active')) {
            $request->merge(['active'=>0]);
        }

        $this->model->create($request->except('_token','languages'));

        return back()->with('success', 'The record was created');

    }


    public function edit($id) {

        return view('core::languages.edit')->with('data',$this->model->all())
            ->with('model',$this->model->getById($id));

    }


    public function update(LangaugeRequest $request, $id)
    {



        if(!$request->has('active')) {

            $request->merge(['active'=>0]);
        }


        $this->model->update($request->except('_token','_method'),$id);

        return Redirect::route('languages.index')->with('success', 'The record was updated');

    }

    public function switchLocale(Request $request)
    {

        if (!empty($request->userLocale)) {

            Session::put('locale', $request->userLocale);
        }

        return redirect($request->header("referer"));


    }


}