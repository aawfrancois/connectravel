<?php

if (!file_exists(BASE_DIR . DIRECTORY_SEPARATOR . '.env')) {
    throw new \RuntimeException(".env file is mandatory on this API");
}

$dotenv = new \Dotenv\Dotenv(BASE_DIR);
$dotenv->overload();

return [
    'displayErrorDetails' => true,
    'dataSource' => [
        'host' => array_key_exists('DB_HOST', $_ENV) ? $_ENV['DB_HOST'] : null,
        'database' => array_key_exists('DB_NAME', $_ENV) ? $_ENV['DB_NAME'] : null,
        'username' => array_key_exists('DB_USERNAME', $_ENV) ? $_ENV['DB_USERNAME'] : null,
        'password' => array_key_exists('DB_PASSWORD', $_ENV) ? $_ENV['DB_PASSWORD'] : null,
    ]
];
