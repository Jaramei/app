<?php

namespace Application\Products\Repositories;

use Application\Core\Repositories\RepositoryEloquent;
use Session;

class ProductsRepository extends RepositoryEloquent implements ProductsInterface
{

    public function getAll($columns = array('*')) {

        return $this->model->where('lang_id','=',Session::get('locale-id'))->get($columns)->sortBy("sort");

    }

}
