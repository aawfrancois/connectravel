<?php

$app->map(['GET', 'POST'],'/', \ConnecTravel\Controller\Home::class . ':index');

$app->map(['GET', 'POST'],'/contact', \ConnecTravel\Controller\Contact::class . ':Contact')
    ->setName('contact');

$app->map(['GET', 'POST'],'/connexion', \ConnecTravel\Controller\Connexion::class . ':connexion')
    ->setName('connexion');

$app->map(['GET', 'POST'],'/accompagnements', \ConnecTravel\Controller\StaticPages::class . ':accompagnements');

$app->map(['GET', 'POST'],'/correspondance', \ConnecTravel\Controller\StaticPages::class . ':correspondance');

$app->map(['GET', 'POST'],'/recrutement', \ConnecTravel\Controller\StaticPages::class . ':recrutement');

$app->map(['GET', 'POST'],'/qui-sommes-nous', \ConnecTravel\Controller\StaticPages::class . ':qsn');

$app->map(['GET', 'POST'],'/liens', \ConnecTravel\Controller\StaticPages::class . ':liens');

$app->map(['GET', 'POST'],'/listuser', \ConnecTravel\Controller\ListUser::class . ':listuser');

$app->map(['GET', 'POST'],'/listmission', \ConnecTravel\Controller\ListMission::class . ':listmission');

$app->map(['GET', 'POST'],'/inscription', \ConnecTravel\Controller\Inscription::class . ':inscription')
    ->setName('inscription');

$app->map(['GET', 'POST'],'/addmission', \ConnecTravel\Controller\AddMission::class . ':addmission')
    ->setName('addmission');

$app->map(['GET', 'POST'],'/adduser', \ConnecTravel\Controller\AddUser::class . ':adduser')
    ->setName('adduser');
