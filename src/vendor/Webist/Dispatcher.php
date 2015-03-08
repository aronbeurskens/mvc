<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name Dispatcher.php
 * @author Webist
 * Created at : Feb 23, 2015 9:14:29 AM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Dispatcher {

    public function handle($handler, $defaultAction = "index") {

        $matchClass = strstr($handler, '::', true);
        $class = ($matchClass === false) ? $handler : $matchClass;

        $macthAction = str_replace("::","",strstr($handler, '::'));
        $action = ($macthAction === "") ? $defaultAction : $macthAction;

        return [
            "reflectionClass" => new \ReflectionClass($class),
            "reflectionMethod" => new \ReflectionMethod($class, $action)
            ];
    }

}