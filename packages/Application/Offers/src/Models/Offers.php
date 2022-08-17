<?php

namespace Application\Offers\Models;

use Eloquent;
use Illuminate\Support\Facades\Session;


/**
 * Application\Offers\Models\Offers
 *
 * @mixin \Eloquent
 */

class Offers extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    protected $fillable = ['user_id','lang_id','name','slug','parent_id','entry','body','title','description','keywords','active','photo'];

    public function parent()
    {

        return $this->belongsTo('Application\Offers\Models\Offers','parent_id')->with('parent');
    }

    public function user() {

        return $this->belongsTo('App\User','user_id');

    }

    public function children()
    {

        return $this->hasMany('Application\Offers\Models\Offers','parent_id')->with('children');
    }

}
