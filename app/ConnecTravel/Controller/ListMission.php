<?php
namespace ConnecTravel\Controller;

class ListMission extends \ConnecTravel\Controller
{
    /**
     * listmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function listmission(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $MissionCollection =  $this->getDataSource()->findAll('Connectravel\Model\Mission');

        $this->getView()->render($response, 'pages/listmission.html.twig', ["MissionCollection" => $MissionCollection]);
    }
}
