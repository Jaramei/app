<?php namespace Application\Products\Http\Controllers;

use Application\Products\Repositories\ProductCategories\ProductCategoriesInterface;
use Application\Core\Services\Crud;
use Application\Products\Http\Requests\ProductCategoriesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ProductsCategoriesController extends Controller
{

    protected $model;
    protected $crud;
    protected $collection;


    public function __construct(ProductCategoriesInterface $model, Crud $crud, Collection $collection)
    {

        $this->model = $model;
        $this->crud = $crud;
        $this->collection = $collection;

    }

    public function index() {


        return view('Products::categories.index')->with('data',$this->model->all());

    }



    public function store(ProductCategoriesRequest $request) {

        $count = $this->getGroupId()+1;

        foreach($request->data as $key => $value) {

            if($value['name']) {

                $myRequest = new \Illuminate\Http\Request();
                $myRequest->setMethod('POST');
                $myRequest->request->add(['group_id' => 1]);
                $myRequest->request->add(['name' => $value['name']]);
                $myRequest->request->add(['body' => $value['body']]);
                $myRequest->request->add(['keywords' => $value['keywords']]);
                $myRequest->request->add(['description' => $value['description']]);
                $myRequest->request->add(['title' => $value['title']]);
                $myRequest->request->add(['active' => $value['active']]);
                if(array_key_exists('photo',$value)) {
                    $myRequest->files->add(['upload'=>$value['photo']]);
                }
                $myRequest->setLaravelSession(['locale-id'=>$key]);
                $myRequest->server->set('REQUEST_URI', '/application/products');

                $result =  $this->crud->store($myRequest);

                $this->model->create(['group_id'=>$count,
                    'name'=>$result->name,
                    'user_id'=>$result->user_id,
                    'lang_id'=>$key,
                    'slug'=>$result->slug,
                    'photo'=>$result->photo,
                    'body'=>$result->body,
                    'keywords'=>$result->keywords,
                    'description'=>$result->description,
                    'title'=>$result->title,
                    'active'=>$result->active
                ]);

            }

        }

        return back()->with('success', 'The record was created');

    }


    public function getGroupId() {

       if($this->model->all()->count()) {

           return DB::table('product_categories')
               ->select('group_id')
               ->latest()
               ->first()->group_id;

       } else {

           return 0;

       }

}

    public function edit($id) {

        return view('Products::categories.edit')->with('model',$this->model->getById($id));

    }


}