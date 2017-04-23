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
        $this->getView()->render($response, 'FrontEnd/StaticPages/accompagnements.html.twig');
    }

    public function correspondance(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/correspondance.html.twig');
    }

    public function recrutement(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/recrutement.html.twig');
    }

    public function qsn(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/qui-sommes-nous.html.twig');
    }

    public function liens(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/liens.html.twig');
    }

    public function Contact(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'FrontEnd/StaticPages/contact.html.twig');
    }
}

