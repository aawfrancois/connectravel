<?php

namespace ConnecTravel\Controller\FrontEnd;

class StaticPages extends \ConnecTravel\Controller
{
    /**
     * Pages without php
     *
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     */
    public function accompagnements(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/accompagnements.html.twig' , [
            "session" => $_SESSION
        ]);
    }

    public function correspondance(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/correspondance.html.twig'  , [
            "session" => $_SESSION
        ]);
    }

    public function recrutement(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/recrutement.html.twig'  , [
            "session" => $_SESSION
        ]);
    }

    public function qsn(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/qui-sommes-nous.html.twig' , [
            "session" => $_SESSION
        ]);
    }

    public function liens(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/liens.html.twig' , [
            "session" => $_SESSION
        ]);
    }

    public function Contact(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/contact.html.twig' , [
            "session" => $_SESSION
        ]);
    }
}

