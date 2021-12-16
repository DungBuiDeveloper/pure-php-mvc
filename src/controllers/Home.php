<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;
use \App\Models\Todo;

class Home extends Controller
{
	function __construct() {
		$this->todoModel = new Todo;
	}
    public function index()
    {
        $view = new view('home/index');
        // $view->assign('data', $todoModel);
    }

	public function getList()
	{
		echo json_encode($this->todoModel->getList());
	}
}
