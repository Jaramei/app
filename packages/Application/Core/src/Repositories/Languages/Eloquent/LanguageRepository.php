<?php namespace Application\Core\Repositories\Languages\Eloquent;

use Application\Core\Repositories\RepositoryEloquent;
use Application\Core\Repositories\Languages\Interfaces\LanguageInterface;

class LanguageRepository extends RepositoryEloquent implements LanguageInterface
{


    public function getLocale($locale) {

        return   $this->model->where('slug',$locale)->get(['id','name','slug'])->first();

    }



}