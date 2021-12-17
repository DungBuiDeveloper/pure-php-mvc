<?php
namespace App\Controllers;

use \BaseClass\Controller;
use \BaseClass\View;
use \App\Models\Todo as TodoModel;
use \App\Requests\TodoRequest;

class Todo extends Controller
{
    public $todoModel;
    public $todoRequest;

    public function __construct()
    {
        $this->todoModel = new TodoModel;
        $this->todoRequest = new TodoRequest;
    }

    /**
     * getList function
     *
     * @return Array List Todo
     */
    public function index()
    {
        $view = new View('json');
        $data = $this->todoModel->getList();
        foreach ($data as $key => $value) {
            switch ($value['status']) {
                case PLANNING:
                    $color = PLANNING_COLOR;
                    break;
                case DOING:
                    $color = DOING_COLOR;
                    break;
                default:
                    $color = COMPLETE_COLOR;
                    break;
            }
            $data[$key]['backgroundColor'] = $color;
        }
        
        return $view->assign('data', json_encode($data));
    }

    /**
     * add function
     *
     * ToDo Store Controller
     * 
     * @return void
     */
    public function add()
    {
        $request = $this->todoRequest;
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

    /**
     * delete function
     *
     * Remove Todo
     * @return void
     */
    public function delete()
    {
        $request = $this->todoRequest;
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

    /**
     * edit function
     *
     * Edit Todo
     * @return void
     */
    public function edit()
    {
        $request = $this->todoRequest;
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
