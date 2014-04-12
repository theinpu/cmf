<?php
/**
 * User: anubis
 * Date: 08.04.2014
 * Time: 18:19
 */

namespace bc\cmf;

abstract class RouteGroup {

    /**
     * @var Application
     */
    private $app;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    protected function addRoute($pattern, Command $command, $methods) {
        if(in_array('get', $methods)) {
            $this->app->addGetCommand($this->getBaseUrl().$pattern, $command);
        }
        if(in_array('post', $methods)) {
            $this->app->addPostCommand($this->getBaseUrl().$pattern, $command);
        }
    }

    protected abstract function getBaseUrl();

    public abstract function initRoutes();
}