<?php

namespace Application\Products\Http\Controllers;

use Application\Products\Http\Requests\ProductsRequest;
use Application\Products\Repositories\ProductsInterface;
use App\Http\Controllers\Controller;
use Application\Core\Services\Crud;


class ProductsController extends Controller
{
    /**
     * @var ProductsInterface
     */
    protected $model;
    protected $crud;

    /**
     * ProductsController constructor.
     * @param ProductsInterface $ProductsRepository
     */

    public function __construct(ProductsInterface $model,Crud $crud)
    {
        $this->model = $model;
        $this->crud = $crud;
     }

    /**
     * Display all Products

     */

    public function index()
    {

        return view('Products::products.index')->with('data',$this->model->getAll());
    }


    public function store(ProductsRequest $request) {

        $this->crud->store($request);

        $this->model->create($request->all());

        return back()->with('success','This record was added.');

    }

}
