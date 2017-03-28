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
        $this->container->view->render($response, 'pages/accompagnements.html.twig');
    }

    public function correspondance(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/correspondance.html.twig');
    }

    public function recrutement(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/recrutement.html.twig');
    }

    public function qsn(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/qui-sommes-nous.html.twig');
    }

    public function liens(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $this->container->view->render($response, 'pages/liens.html.twig');
    }
}
