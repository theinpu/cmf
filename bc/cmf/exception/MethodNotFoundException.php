<?php
/**
 * User: inpu
 * Date: 05.09.13 13:59
 */

namespace bc\cmf\exception;


class MethodNotFoundException extends Exception
{

    public function __construct($class, $method)
    {
        parent::__construct(sprintf("Method '%s:%s' not found", $class, $method));
    }

}