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

        //None Title
        $resNonTitle = $this->http->request('POST', 'todo/add', [
            'form_params' => [
                'start' => date("Y-m-d", strtotime("- 1 day")),
                'end' => date("Y-m-d", strtotime("+ 3 day"))
            ]
        ]);
        $this->assertEquals(200, $resNonTitle->getStatusCode());
        $this->assertArrayHasKey('error', json_decode($resNonTitle->getBody()->getContents() ,true));

        //None Start
        $resNonStart = $this->http->request('POST', 'todo/add', [
            'form_params' => [
                'title' => 'php unit controller test',
                'end' => date("Y-m-d", strtotime("+ 3 day"))
            ]
        ]);
        $this->assertEquals(200, $resNonStart->getStatusCode());
        $this->assertArrayHasKey('error', json_decode($resNonStart->getBody()->getContents() ,true));

        //None End
        $resNonEnd = $this->http->request('POST', 'todo/add', [
            'form_params' => [
                'title' => 'php unit controller test',
                'start' => date("Y-m-d", strtotime("- 1 day")),
            ]
        ]);
        $this->assertEquals(200, $resNonEnd->getStatusCode());
        $this->assertArrayHasKey('error', json_decode($resNonEnd->getBody()->getContents() ,true));
    }

    //Test Delete
    public function testTodoDelete() {
        $todoList   = $this->todoModel->getList();
        if(sizeof($todoList) > 0){
            $res = $this->http->request("POST", 'todo/delete', [
                'form_params' => [
                    'id' => $todoList[0]['id'],
                ]
            ]);
            $this->assertEquals(200, $res->getStatusCode());
            
            $this->assertJsonStringEqualsJsonString(
                json_encode(array("status" => "ok")), $res->getBody()->getContents()
            );

            //None Id
            $resNonId = $this->http->request("POST", 'todo/delete', [
                'form_params' => [
                    'id' => 'none',
                ]
            ]);
            $this->assertEquals(200, $resNonId->getStatusCode());
            $this->assertArrayHasKey('error', json_decode($resNonId->getBody()->getContents() ,true));
        }
    }

    //Test Edit
    public function testTodoEdit() {
        $todoList   = $this->todoModel->getList();
        if(sizeof($todoList) > 0){
            $update = $todoList[0];
            $update['name'] = 'php edit unit test';
            $res = $this->http->request("POST", 'todo/edit', [
                'form_params' => $update
            ]);
            $this->assertEquals(200, $res->getStatusCode());
            
            $this->assertJsonStringEqualsJsonString(
                json_encode(array("status" => "ok")), $res->getBody()->getContents()
            );

            //None Id
            $resNonId = $this->http->request("POST", 'todo/edit', [
                'form_params' => [
                    'id' => 'none',
                ]
            ]);
            $this->assertEquals(200, $resNonId->getStatusCode());
            $this->assertArrayHasKey('error', json_decode($resNonId->getBody()->getContents() ,true));
        }
    }

    

    public function tearDown() {
        $this->http = null;
    }

}