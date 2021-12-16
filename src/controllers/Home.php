<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;

class Home extends Controller
{
    public function index()
    {
        return new View('home/index');
    }
}
