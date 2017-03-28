<?php


namespace ConnecTravel\Controller;


class Contact extends \ConnecTravel\Controller
{
    public function Contact(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/contact.html.twig');
    }

}