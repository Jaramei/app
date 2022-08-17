<?php

namespace Application\Core\Http\Composers;

use Illuminate\View\View;

use Application\Core\Repositories\packages\Interfaces\PackageInterface as package;

class packagesComposer  {

    private $package;

    public function __construct(package $package) {

        $this->package = $package;

    }

    /**
     * @param View $view
     */

    public function compose(view $view) {

        $view->with('packages',$this->package->getByColumn('status',1));

    }


}