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

    /**
     * @return Application
     */
    protected function getApp() {
        return $this->app;
    }

    public abstract function initRoutes();
}