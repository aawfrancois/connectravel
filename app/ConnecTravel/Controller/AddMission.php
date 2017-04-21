<?php
namespace ConnecTravel\Controller;

class AddMission extends \ConnecTravel\Controller
{
    /**
     * addmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function addmission(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $request->getParsedBody();

        var_dump($request->getParsedBody());

        $this->getView()->render($response, 'pages/addmission.html.twig');
    }

}
