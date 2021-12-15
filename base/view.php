<?php
namespace BaseClass;

class View
{
    private $data = array();

    private $render = false;

    public function __construct($template)
    {
        try {
            $file = APP_ROOT . '/src/views/' . $template . '.php';

            if (file_exists($file)) {
                $this->render = $file;
            } else {
                errorLog('Template ' . $template . ' not found!');
            }
        } catch (\Throwable $th) {
            errorLog($e->errorMessage());
        }
    }

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}
