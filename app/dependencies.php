<?php

/** @var \Slim\Container $container */
$container = $app->getContainer();

// debug ?
$container['debug'] = function () {
    return true;
};

// Twig
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(BASE_DIR . '/views', [
        'cache' => false
    ]);

    $view->addExtension(new Slim\Views\TwigExtension($container['router'], '/'));

    return $view;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['127.0.0.1'] . ";dbname=" . $db['Connect'],
        $db['root'], $db['guerre1995']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
