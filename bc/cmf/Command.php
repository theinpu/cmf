<?php
/**
 * User: inpu
 * Date: 18.01.14
 * Time: 23:37
 */

namespace bc\cmf;

use bc\cmf\exception\ClassNotFoundException;
use bc\cmf\exception\MethodNotFoundException;

class Command
{

    private $controller;
    private $method;
    private $app;

    public function __construct($controller, $method)
    {
        $this->controller = $controller;
        $this->method = $method;
    }

    /**
     * @throws \RuntimeException
     * @throws exception\MethodNotFoundException
     * @throws exception\ClassNotFoundException
     * @return mixed
     */
    public function execute()
    {
        $controller = $this->prepareController();

        $this->beforeCall($controller);

        $result = call_user_func_array(array($controller, $this->method), func_get_args());

        $this->afterCall($controller);

        return $result;
    }

    public final function getCallback()
    {
        return array($this, 'execute');
    }

    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @param Controller $controller
     */
    private function beforeCall($controller)
    {
        call_user_func(array($controller, 'beforeCall'));
        if (method_exists($controller, 'beforeCall' . ucfirst($this->method))) {
            call_user_func_array(array($controller, 'beforeCall' . ucfirst($this->method)), func_get_args());
        }
    }

    /**
     * @param Controller $controller
     */
    private function afterCall($controller)
    {
        if (method_exists($controller, 'afterCall' . ucfirst($this->method))) {
            call_user_func_array(array($controller, 'afterCall' . ucfirst($this->method)), func_get_args());
        }
        call_user_func(array($controller, 'afterCall'));
    }

    /**
     * @throws \RuntimeException
     * @throws exception\MethodNotFoundException
     * @throws exception\ClassNotFoundException
     * @return Controller
     */
    private function prepareController()
    {
        if (is_null($this->app)) {
            throw new \RuntimeException("Need assign app first");
        }
        $className = $this->controller;
        if (!class_exists($className)) {
            throw new ClassNotFoundException($className);
        }
        $controller = new $className($this->app);
        if (!($controller instanceof Controller)) {
            throw new ClassNotFoundException($className);
        }
        if (!method_exists($controller, $this->method)) {
            throw new MethodNotFoundException($className, $this->method);
        }
        return $controller;
    }

}