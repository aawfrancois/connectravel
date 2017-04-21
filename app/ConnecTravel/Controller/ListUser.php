<?php

namespace ConnecTravel\Controller;


class ListUser extends \ConnecTravel\Controller
{
    /**
     * listcompanion page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function listuser(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $CompanionCollection =  $this->getDataSource()->findAll('Connectravel\Model\User');

        $this->getView()->render($response, 'pages/listuser.html.twig', ["CompanionCollection" => $CompanionCollection]);
    }
}