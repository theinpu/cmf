<?php
/**
 * User: inpu
 * Date: 18.01.14
 * Time: 23:43
 */

namespace bc\cmf;


abstract class Controller
{
    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function template($template)
    {
        $this->app->getSlim()->view()->display($template . '.twig');
    }

    protected function addData($data)
    {
        $this->app->getSlim()->view()->appendData($data);
    }

    protected function getData($key) {
        return $this->app->getSlim()->view()->getData($key);
    }

    /**
     * @return \Slim\Slim
     */
    protected final function getSlim()
    {
        return $this->app->getSlim();
    }

    /**
     * @return \Slim\Http\Request
     */
    protected final function getRequest()
    {
        return $this->app->getSlim()->request();
    }

    public function beforeCall()
    {
    }

    public function afterCall()
    {
    }
} 