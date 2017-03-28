<?php

namespace ConnecTravel;

class Controller
{
    /**
     * @var \Slim\Container
     */
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}
