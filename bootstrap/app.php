<?php

class Bootstrap
{
    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        
        if ($this->request['controller'] == '') {
            $this->controller = '\\App\\Controllers\\Home';
        } else {
            $this->controller = '\\App\\Controllers\\'.$this->request['controller'];
        }
        if ($this->request['action'] == '') {
            $this->action = 'index';
        } else {
            $this->action = $this->request['action'];
        }
    }

    public function initRequest()
    {
        try {
            $init = ['controller' => new $this->controller() , 'action' => $this->action];
            return $init;
        } catch (\Throwable $e) {
            errorLog($e);
        }
    }
}
