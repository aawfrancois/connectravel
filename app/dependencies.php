<?php

/** @var \Slim\Container $container */
$container = $app->getContainer();

// debug ?
$container['debug'] = function () {
    return true;
};

// Twig
$container['view'] = function (\Slim\Container $container) {
    $view = new \Slim\Views\Twig(BASE_DIR . '/views', [
        'cache' => false
    ]);

    $view->addExtension(new Slim\Views\TwigExtension($container['router'], '/'));

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
