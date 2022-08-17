<?php

namespace Application\Products\Models;

use Application\Core\Models\Base;

class ProductCategories extends Base
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $fillable = ['name','photo','entry','slug','body','keywords','decription','title','group_id','lang_id','user_id','active'];


    public function lang() {

        return $this->belongsTo('Application\Core\Models\Languages');

    }

}
