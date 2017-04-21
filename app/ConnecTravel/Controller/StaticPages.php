<?php

namespace ConnecTravel\Controller;

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
        $this->getView()->render($response, 'StaticPages/accompagnements.html.twig');
    }

    public function correspondance(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'StaticPages/correspondance.html.twig');
    }

    public function recrutement(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'StaticPages/recrutement.html.twig');
    }

    public function qsn(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'StaticPages/qui-sommes-nous.html.twig');
    }

    public function liens(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->getView()->render($response, 'StaticPages/liens.html.twig');
    }
}

