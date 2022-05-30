<?php
/**
 * Get URI path for detech controller.
 * @return array $uri
 */
function getUri()
{
    $uri = explode("/", trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $controller = str_replace(' ', '', ucwords(str_replace('-', ' ', $uri[0] ?? null)));
    $action = $uri[1] ?? null;
    return array(
        'controller' => $controller,
        'action' => $action
    );
}

/**
 * errorLog function
 *
 * Display Error And Log To File
 * @param [type] $e Log Message
 * @return void
 */
function errorLog($e)
{
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error lol', true, 500);
    echo '<h1>Something went wrong!</h1>';

    $logFilename = "../logs";
    if (!file_exists($logFilename)) 
    {
        // create directory/folder uploads.
        mkdir($logFilename, 0777, true);
    }
    $logFileData = $logFilename.'/log_' . date('d-M-Y') . '.log';
   
    file_put_contents($logFileData, $e . "\n", FILE_APPEND);
    die();
}
