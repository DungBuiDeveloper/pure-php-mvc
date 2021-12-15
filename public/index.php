<?php
//Autoload
require __DIR__.'/../vendor/autoload.php';


//Boostrap App
$app = require_once __DIR__.'/../bootstrap/app.php';
$bootstrap = new Bootstrap(getUri()); // Get all url parameters
$app = $bootstrap->initRequest();
$app['controller']->executeAction($app['action']);

