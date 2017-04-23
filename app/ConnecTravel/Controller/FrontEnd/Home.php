<?php

namespace ConnecTravel\Controller\FrontEnd;

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
        $this->getView()->render($response, 'FrontEnd/Home/index.html.twig');
    }
}
