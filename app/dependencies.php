<?php

// Start PHP session
// FIXME Replace this by a service...
session_start();

/** @var \Slim\Container $container */
$container = $app->getContainer();

// debug ?
$container['debug'] = function () {
    return true;
};

// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Twig
$container['view'] = function (\Slim\Container $container) {
    $view = new \Slim\Views\Twig(BASE_DIR . '/views', [
        'debug' => true,
        'cache' => false,
    ]);

    $view->addExtension(new Slim\Views\TwigExtension($container['router'], '/'));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// dataSource
$container['dataSource'] = function (\Slim\Container $container) {
    $settings = $container->get('settings');

    return new \Modelight\DataSource\MySQL(
        $settings['dataSource']['host'],
        $settings['dataSource']['database'],
        $settings['dataSource']['username'],
        $settings['dataSource']['password']
    );
};
