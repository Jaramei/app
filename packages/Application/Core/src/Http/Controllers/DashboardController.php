<?php namespace Application\Core\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

    protected $app;

    public function index() {

        return view('core::index');

    }

}