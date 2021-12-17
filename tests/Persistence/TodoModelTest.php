<?php

namespace DatabaseTesting\Tests\Persistence\Mappers;
use App\Models\Todo as TodoModel;
use PHPUnit\Framework\TestCase;

class TodoModelTest extends TestCase
{
    public $todoModel;

    public function __construct()
    {
        $this->todoModel = new TodoModel;
    }

    public function testTodoList() {
        $todoList   = $this->todoModel->getList();
        //Data return is Array
        $this->assertInternalType('array', $todoList);
        
        if(sizeof($todoList) > 0){
            //Each Data For display calendar
            $toto = $todoList[0];
            $this->assertArrayHasKey('start', $toto);
            $this->assertArrayHasKey('end', $toto);
            $this->assertArrayHasKey('title', $toto);
            $this->assertArrayHasKey('id', $toto);
            $this->assertArrayHasKey('status', $toto);
        }
        
        
    }

    public function testInsert() {
        $data=[
            'title' => 'todo unit php',
            'start' => date("Y-m-d", strtotime("+ 1 day")),
            'end' => date("Y-m-d", strtotime("+ 2 day")),
            'status' => 1
        ];
        $id = $this->todoModel->addTodo($data);
       
        //Data return is id have type number
        $this->assertInternalType('int', (int)$id);
    }

    public function testEdit() {
        $todoList   = $this->todoModel->getList();
        if(sizeof($todoList) > 0){
            $data = $todoList[0];
            $data['title'] = 'php unit edit';
            $status = $this->todoModel->editTodo($data);
            $this->assertTrue($status);
        }
    }

    public function testDelete() {
        $todoList   = $this->todoModel->getList();
        if(sizeof($todoList) > 0){
            $data = $todoList[0];
            $status = $this->todoModel->deleteTodo(['id' => $data['id']]);
            $this->assertTrue($status);
        }
    }
}