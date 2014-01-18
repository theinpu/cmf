<?php
/**
 * User: inpu
 * Date: 05.09.13 13:51
 */

namespace bc\cmf\exception;


class Exception extends \Exception
{

    public function __construct($message = "Generic exception")
    {
        parent::__construct($message, 0, null);
    }

}