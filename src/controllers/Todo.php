<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;
use \App\Models\Todo as TodoModel;
use \App\Requests\TodoRequest;

class Todo extends Controller
{
    public $todoModel;

    public function __construct()
    {
        $this->todoModel = new TodoModel;
    }

    public function getList()
    {
        $view = new View('json');
        $data = $this->todoModel->getList();
        foreach ($data as $key => $value) {
            switch ($value['status']) {
                case PLANNING:
                    $color = '#8d8d3f';
                    break;
                case DOING:
                    $color = '#8d3f75';
                    break;
                
                default:
                    $color = '#408d3f';
                    break;
            }
            $data[$key]['backgroundColor'] = $color;
        }
        
        return $view->assign('data', json_encode($data));
    }

    public function add()
    {
        $request = new TodoRequest();
        $request->addValidate($_POST);
        $view = new View('json');
        if ($request->isSuccess()) {
            try {
                return $view->assign('data', json_encode(['id' => $this->todoModel->addTodo($_POST)]));
            } catch (\Throwable $e) {
                errorLog($e->getMessage());
            }
        } else {
            return $view->assign('data', json_encode(['error' => $request->getErrors()]));
        }
    }

    public function delete()
    {
        $request = new TodoRequest();
        $request->deleteValidate($_POST);
        $view = new View('json');
        if ($request->isSuccess()) {
            try {
                $this->todoModel->deleteTodo($_POST);
                return $view->assign('data', json_encode(['status' => 'ok']));
            } catch (\Throwable $e) {
                errorLog($e->getMessage());
            }
        } else {
            return $view->assign('data', json_encode(['error' => $request->getErrors()]));
        }
    }

    public function edit()
    {
        $request = new TodoRequest();
        $request->editValidate($_POST);
        $view = new View('json');
        if ($request->isSuccess()) {
            try {
                $this->todoModel->editTodo($_POST);
                return $view->assign('data', json_encode(['status' => 'ok']));
            } catch (\Throwable $e) {
                errorLog($e->getMessage());
            }
        } else {
            return $view->assign('data', json_encode(['error' => $request->getErrors()]));
        }
    }
}
