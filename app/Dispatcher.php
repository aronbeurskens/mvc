<?php

/**
 * Project name: mvc
 * @package
 * @name BaseController.php
 * @author Fethi Kus <fethi.kus@adchieve.com>
 * Created at : Mar 19, 2015 11:27:43 AM
 * UTF-8
 *
 */

namespace app;

/**
 * A partly role of a Director. Whom shares the routes, permissions etc.
 */
class Dispatcher
{
    public $request;
    public $router;

    private $handler;

    public function __construct($request, $router)
    {
        $this->request = $request;
        $this->router = $router;

    }


    public function handle($defaultAction = "index")
    {

          //$this->request = $request;
          //$this->router = $router;

        $this->handler = $this->router->match($this->request->server("REQUEST_URI"), $this->request->method());

        $matchClass = strstr($this->handler, '::', true);
        $class = ($matchClass === false) ? $this->handler : $matchClass;

        $macthAction = str_replace("::", "", strstr($this->handler, '::'));
        $action = ($macthAction === "") ? $defaultAction : $macthAction;

        //return [
        //    "reflectionClass" => new \ReflectionClass($class),
        //    "reflectionMethod" => new \ReflectionMethod($class, $action)
        //    ];
        $reflectionClass = new \ReflectionClass($class);

        $reflectionMethod = new \ReflectionMethod($class, $action);

        return $reflectionMethod->invokeArgs($reflectionClass->newInstance(), [$this->request->parameters()]);
    }

}