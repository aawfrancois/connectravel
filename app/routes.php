<?php

$app->map(['GET', 'POST'], '/', \ConnecTravel\Controller\FrontEnd\Home::class . ':index');

// FrontEnd

$app->map(['GET', 'POST'], '/accompagnements', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':accompagnements');
$app->map(['GET', 'POST'], '/correspondance', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':correspondance');
$app->map(['GET', 'POST'], '/recrutement', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':recrutement');
$app->map(['GET', 'POST'], '/qui-sommes-nous', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':qsn');
$app->map(['GET', 'POST'], '/liens', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':liens');
$app->map(['GET', 'POST'], '/contact', \ConnecTravel\Controller\FrontEnd\StaticPages::class . ':Contact');

// BackEnd

$app->map(['GET', 'POST'], '/admin/user/subscription', \ConnecTravel\Controller\BackEnd\User::class . ':subscription');
$app->map(['GET', 'POST'], '/admin/user/login', \ConnecTravel\Controller\BackEnd\User::class . ':login');
$app->map(['GET', 'POST'], '/admin/user/logout', \ConnecTravel\Controller\BackEnd\User::class . ':logout');

$app->map(['GET', 'POST'], '/admin/user', \ConnecTravel\Controller\BackEnd\User::class . ':index');
$app->map(['GET', 'POST'], '/admin/user/edit', \ConnecTravel\Controller\BackEnd\User::class . ':edit');

$app->map(['GET', 'POST'], '/admin/mission', \ConnecTravel\Controller\BackEnd\Mission::class . ':index');
$app->map(['GET', 'POST'], '/admin/mission/edit', \ConnecTravel\Controller\BackEnd\Mission::class . ':edit');


