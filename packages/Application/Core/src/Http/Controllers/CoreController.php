<?php

namespace Application\Core\Http\Controllers;

use App\Http\Controllers\Controller;
USE Illuminate\Filesystem\Filesystem;
use Config;
class CoreController extends Controller
{

    protected $files;

    function __construct(Filesystem $files)
    {

        $this->files = $files;

    }

    public function index()
    {


        return view('core::index');

    }

}
