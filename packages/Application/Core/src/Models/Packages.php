<?php namespace Application\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model

{

   protected $fillable = ['name','version','author','description','provider','controller','status','icon'];

}