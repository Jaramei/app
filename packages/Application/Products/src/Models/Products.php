<?php

namespace Application\Products\Models;

use Application\Core\Models\Base;

class Products extends Base
{

    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'Products';

    protected $fillable = ['name','body','lang_id','status'];


}
