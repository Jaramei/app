<?php

namespace Application\Offers;

use Artisan;
use Schema;

class Package
{

    public static function activate()
    {
       
        Artisan::call('migrate', ['--force' => true, '--path' => 'Packages/Offers/database/migrations']);
    }

    public static function deactivate(){}

    public static function remove()
    {
       
        Schema::dropIfExists('Offers');
    }

}