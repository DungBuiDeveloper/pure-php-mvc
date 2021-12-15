<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;
use \App\Models\Todo;

class Home extends Controller
{
    public function index()
    {
        $todoModel = new Todo;
        $todoModel->getList();
        $view = new view('home/index');
        $view->assign('data', $todoModel);
    }
}
