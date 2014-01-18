<?php
/**
 * User: inpu
 * Date: 05.09.13 13:56
 */

namespace bc\cmf\exception;


class ClassNotFoundException extends Exception
{

    public function __construct($class)
    {
        parent::__construct(sprintf("Class '%s' not found", $class));
    }

}