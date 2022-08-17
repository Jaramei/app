<?php

namespace Application\Offers\Repositories\Eloquent;

use Application\Core\Repositories\RepositoryEloquent;
use Application\Offers\Repositories\Interfaces\OffersInterface;
use Session;

class OffersRepository extends RepositoryEloquent implements OffersInterface
{

    public function getAll($columns = array('*')) {

        return $this->model->whereNull('parent_id')->where('lang_id','=',Session::get('locale-id'))->get($columns)->sortBy("sort");

    }

    public function category() {

        return $this->model->whereNull('parent_id')->where('lang_id','=',Session::get('locale-id'))->get()->sortBy("sort");

    }

}
