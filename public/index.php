<?php
session_start();
// Composer autoloader
require '../vendor/autoload.php';

// we define a BASE_DIR constant
define('BASE_DIR', dirname(__DIR__));

// instanciate new Slim app with preload settings :)
$app = new \Slim\App([
    'settings' => require_once BASE_DIR . "/app/settings.php"
]);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// services
require_once BASE_DIR . '/app/dependencies.php';

// middlewares
require_once BASE_DIR . '/app/middlewares.php';

// routes
require_once BASE_DIR . '/app/routes.php';

// run app!
$app->run();
