<?php

/**
 * Project name: Webist MVC
 * @package
 * @name Container.php
 * @author Webist
 * Created at : Mar 29, 2015 7:57:21 PM
 * UTF-8
 *
 */
namespace app\base;

class Container
{
    protected $values = [];

    function __set($name, $value)
    {
        $this->values[$name] = $value;
    }

    function __get($name)
    {
        if (!isset($this->values[$name])) {
            throw new \Exception(sprintf("Value `%s` is not defined", $name));
        }

        return is_callable($this->values[$name]) ? $this->values[$name]($this) : $this->values[$name];
    }

}