<?php

namespace Application\Offers\Http\Composers;

use Application\Offers\Repositories\Interfaces\OffersInterface;

use Illuminate\View\View;

class OffersComposer  {

    /**
     * @param View $view
     */


    public function compose(view $view) {

        $view->with('offerCategory',app(OffersInterface::class)->category()->pluck('name','id')->toArray());

    }


}