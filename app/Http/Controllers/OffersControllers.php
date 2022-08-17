<?php
/**
 * Created by PhpStorm.
 * User: Jakub
 * Date: 08.11.2018
 * Time: 00:04
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OffersController

{

    public function index(Request $request) {

        return $request->slug;

    }

}