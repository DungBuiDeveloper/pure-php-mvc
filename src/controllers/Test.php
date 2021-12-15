<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;

class Index extends Controller
{
    public function index()
    {
        $view = new view('home/index');
        $view->assign('s', 'variable home');
    }
}
