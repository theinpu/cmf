<?php
/**
 * User: inpu
 * Date: 14.10.13
 * Time: 22:41
 */

namespace bc\cmf\exception;


class FileNotFoundException extends Exception
{

    public function __construct($file = '')
    {
        parent::__construct("File not found: " . $file);
    }

}