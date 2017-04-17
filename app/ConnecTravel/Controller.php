<?php

namespace ConnecTravel;

class Controller
{
    /**
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Controller constructor
     *
     * @param \Slim\Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Returns view service (Twig)
     *
     * @return \Slim\Views\Twig
     */
    protected function getView()
    {
        return $this->container->get('view');
    }

    /**
     * Returns dataSource service (Modelight MySQL DataSource)
     *
     * @return \Modelight\DataSource\MySQL
     */
    protected function getDataSource()
    {
        return $this->container->get('dataSource');
    }
}
