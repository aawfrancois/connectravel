<?php

namespace ConnecTravel\Controller;

class Inscription extends \ConnecTravel\Controller
{
    public function Inscription(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/inscription.html.twig');
    }
}
