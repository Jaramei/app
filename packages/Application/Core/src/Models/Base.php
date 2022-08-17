<?php namespace Application\Core\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Eloquent
{

    use Cachable;
  //  use SoftDeletes;

}