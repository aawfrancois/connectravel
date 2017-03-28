<?php
/**
 * Created by PhpStorm.
 * User: antoinefrancois
 * Date: 26/03/2017
 * Time: 16:09
 */

namespace ConnecTravel\Controller;


class Addmission extends \ConnecTravel\Controller
{
    /**
     * addmission page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function addmission(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/addmission.html.twig');
    }

}