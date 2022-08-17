<?php

namespace Application\Core\Models\Packages;

use Application\Core\Models\Base;

class Translations extends Base
{
    protected $guarded = [];

    protected $primaryKey = 'id';
    protected $table = 'packages_translations';

    protected $fillable = ['package_id','lang_id','name','slug','route'];

    public function lang() {

        return $this->belongsTo('Application\Core\Models\Languages');

    }

    public function package() {

        return $this->belongsTo('Application\Core\Models\Packages');

    }

}