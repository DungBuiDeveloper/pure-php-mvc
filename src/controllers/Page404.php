<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;

class Page404 extends Controller
{
    public function index()
    {
        return new View('page404');
    }
}
