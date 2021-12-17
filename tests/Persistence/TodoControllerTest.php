<?php

namespace DatabaseTesting\Tests\Persistence\Mappers;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use App\Models\Todo as TodoModel;

class TodoControllerTest extends TestCase
{
    private $http;
    public $todoModel;

    public function setUp()
    {
        $this->http = new Client(['base_uri' => $_ENV['IP_APP']]);
        $this->todoModel = new TodoModel;
    }

    public function testTodoGetList() {
        $res = $this->http->request('GET', '/todo');
        $this->assertEquals(200, $res->getStatusCode());

        $contents = json_decode($res->getBody()->getContents(), true);

        $this->assertInternalType('array',  $contents);
    }

    public function testTodoAdd() {

        $res = $this->http->request('POST', 'todo/add', [
            'form_params' => [
                'title' => 'php unit controller test',
                'start' => date("Y-m-d", strtotime("- 1 day")),
                'end' => date("Y-m-d", strtotime("+ 3 day"))
            ]
        ]);
        
        $this->assertEquals(200, $res->getStatusCode());

        $contents = json_decode($res->getBody()->getContents());
        
        $this->assertInternalType('int', (int)$contents->id);
    }

    public function testTodoDelete() {
        $todoList   = $this->todoModel->getList();
        
        if(sizeof($todoList) > 0){
            $res = $this->http->request('DELETE', 'todo/delete', [
                'form_params' => [
                    'id' => 'php unit controller test',
                ]
            ]);
            
            $this->assertEquals(200, $res->getStatusCode());
    
            $contents = json_decode($res->getBody()->getContents());
            
            $this->assertInternalType('int', (int)$contents->id);
        }
        
    }

    

    public function tearDown() {
        $this->http = null;
    }

}