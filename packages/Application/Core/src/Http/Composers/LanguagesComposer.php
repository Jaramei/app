<?php

namespace Application\Core\Http\Composers;

use Illuminate\View\View;

use Application\Core\Repositories\Languages\Interfaces\LanguageInterface as Lang;

class LanguagesComposer  {

    private $lang;

    public function __construct(Lang $lang) {

        $this->lang = $lang;

    }

    /**
     * @param View $view
     */

    public function compose(view $view) {

        $view->with('languages',$this->lang->getByColumn('active',1));

    }


}