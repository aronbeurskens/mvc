<?php

/**
 * Project name: Webist MVC
 * @package
 * @name BaseController.php
 * @author Webist
 * Created at : Mar 19, 2015 11:27:43 AM
 * UTF-8
 *
 */

namespace app\base;

class Dispatcher
{

    public function dispatch($request, $router, $defaultAction = "index")
    {
        //find the route
        $handler = $router->match($request->server("REQUEST_URI"), $request->method());

        //extract the controller
        $matchClass = strstr($handler, '::', true);
        $class = ($matchClass === false) ? $handler : $matchClass;

        //extract the action
        $macthAction = str_replace("::", "", strstr($handler, '::'));
        $action = ($macthAction === "") ? $defaultAction : $macthAction;

        return $this->invoke($class, $action, $request);
    }

    /**
     * build callback via reflection object
     *
     * @param type $class
     * @param type $action
     * @param type $request
     * @return type
     */
    private function invoke($class, $action, $request)
    {

        $reflectionClass = new \ReflectionClass($class);

        /**
         * @Notice, assuming every controller should inject the Request
         * We could do this, if($reflectionClass->hasMethod("__construct")),
         * but then the controller would try to get request via magical ways.
         *
         * We have an open question here
         * http://stackoverflow.com/questions/29314552/what-is-the-point-of-view-controller-without-an-input-injection-in-mvc
         *
         */
        $class = $reflectionClass->newInstance($request);

        //invoke the controller object with request injection and the action with parameters injection
        $reflectionMethod = new \ReflectionMethod($class, $action);

        return $reflectionMethod->invokeArgs($class, [$request->parameters()]);
    }

}