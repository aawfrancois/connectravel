<?php
namespace ConnecTravel\Controller\FrontEnd;

class Error extends \ConnecTravel\Controller
{
    /**
     * 403 page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function error403(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/errorPages/403.html.twig');
    }

    public function error404(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/errorPages/404.html.twig');
    }

}
