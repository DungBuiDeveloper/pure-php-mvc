<?php
namespace BaseClass;

abstract class Controller
{

    /**
     * executeAction function
     *
     * @param [STRING] $action method name in controller
     * @return void
     */
    public function executeAction($action)
    {
        try {
            return $this->{$action}();
        } catch (\Throwable $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function view($view)
    {
        $file = APP_ROOT . '/src/views/' . $view . '.php';
        // Check for view file
        if (is_readable($file)) {
            require_once $file;
        } else {
            // View does not exist
            die('<h1> 404 Page not found </h1>');
        }
    }
}
