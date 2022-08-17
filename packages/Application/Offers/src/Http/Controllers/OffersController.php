<?php

namespace Application\Offers\Http\Controllers;

use Application\Offers\Http\Requests\OffersRequest;
use Application\Offers\Repositories\Interfaces\OffersInterface as Repository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Application\Core\Services\Crud;


class OffersController extends Controller
{
    /**
     * @var OffersInterface
     */
    protected $model;
    protected $crud;

    /**
     * OffersController constructor.
     * @param OffersInterface $OffersRepository
     */

    public function __construct(Repository $model,Crud $crud)
    {
        $this->model = $model;
        $this->crud = $crud;
    }

    /**
     * Display all Offers

     */

    public function index()
    {

        return view('Offers::offers.index')->with('data',$this->model->getAll());
    }

    public function store(OffersRequest $request) {

        $this->crud->store($request);

        $this->model->create($request->all());

        return back()->with('success','This record was added.');

    }


    public function edit($id) {

        return view('Offers::offers.edit')->with('model',$this->model->getById($id));

    }


    public function update($id,OffersRequest $request) {

        $this->crud->update($id,$this->model,$request);

        $this->model->update($request->except('upload'),$id);

        return back()->with('success','This record was updated.');

    }


    public function delete(Request $request) {

            $this->crud->delete($this->model->getById($request->id));

            $this->model->destroy($request->id);

            return back()->with('success','This record was deleted.');

    }


    public function sort(Request $request) {

        $this->positionMenu(json_decode($request->input('sort')), null);

    }

    private function positionMenu(array $menuItems, $parentId) {

        foreach ($menuItems as $index => $menuItem) {

            $this->model->update(['sort'=>$index + 1,'parent_id'=>$parentId],$menuItem->id);

            if (isset($menuItem->children)) {

                $this->positionMenu($menuItem->children,$menuItem->id);

            }
        }
    }





}
