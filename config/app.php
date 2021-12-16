<?php
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// URL Root
define('APP_URL', $_ENV['APP_URL']);
// Site Name
define('APP_NAME', $_ENV['APP_NAME']);

// Database
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASS', $_ENV['DB_PASS']);
define('DB_NAME', $_ENV['DB_NAME']);


define('PLANNING', $_ENV['PLANNING']);
define('DOING', $_ENV['DOING']);
define('COMPLETE', $_ENV['COMPLETE']);
