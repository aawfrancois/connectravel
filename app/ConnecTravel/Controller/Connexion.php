<?php

namespace ConnecTravel\Controller;

class Connexion extends \ConnecTravel\Controller
{
    /**
     * Connexion page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function connexion(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/connexion.html.twig');
    }

    public function authentification()
    {

    }
}
