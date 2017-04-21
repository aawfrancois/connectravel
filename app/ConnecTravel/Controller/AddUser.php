<?php
/**
 * Created by PhpStorm.
 * User: antoinefrancois
 * Date: 19/04/2017
 * Time: 17:50
 */

namespace ConnecTravel\Controller;


class AddUser extends \ConnecTravel\Controller
{
    /**
     * adduser page
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function adduser(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'pages/adduser.html.twig');
    }
}