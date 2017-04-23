<?php

namespace ConnecTravel\Controller\BackEnd;

class Mission extends \ConnecTravel\Controller
{
    /**
     * listmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function index(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $MissionCollection =  $this->getDataSource()->findAll('Connectravel\Model\Mission');

        $this->getView()->render($response, 'BackEnd/Mission/missionList.html.twig', ["MissionCollection" => $MissionCollection]);
    }

    /**
     * addmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function edit(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'BackEnd/Mission/editmission.html.twig');
    }
}
