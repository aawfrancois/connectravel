<?php

namespace ConnecTravel\Controller;

use ConnecTravel\Model\CompanionCollection;

class Home extends \ConnecTravel\Controller
{
    /**
     * Home page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function index(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->get('view')->render($response, 'Home/index.html.twig');
    }
}
