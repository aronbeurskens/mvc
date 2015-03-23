<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name Router.php
 * @author Webist
 * Created at : Dec 26, 2014 4:07:18 PM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Router
{
    //avaiable (registered) location-links (destinations) container
    //private $routes = [];

    private $handler = "app\\controllers\\notfound";

    /**
     *
     * @param type $pattern
     * @param \src\vendor\Webist\callable $handler
     * @return \src\vendor\Webist\Router
     */
    function get($pattern, callable $handler)
    {
        //$this->routes[$pattern]["GET"] = $handler;
        //return $this;
    }

    function post($pattern, callable $handler)
    {
        //$this->routes[$pattern]["POST"] = $handler;
        //return $this;
    }

    function match($context, $method)
    {

        //@todo use yaml file for routes. Reading yml file with fget will allow to seek the file easily while keeping the memory low.
        //Once the match found fget can stop reading and returning the line that matched.

        //@Notice, code below is not an array loop, which is a faster matching by checking on array_key only.
        //@todo use XCache (PHP accelerator), at user level (so it will not lock for other requests)
        //@Notice since $routes is not global class var (not $this->routes), by the end of the function memory will be auto-freed-up.
        $routes = include_once "../data/system/routes.php";

        if (array_key_exists($context, $routes)) { // "/" GET

            if (array_key_exists($method, $routes[$context]["controller"])) {
                //@todo keep track of handlers usage and reindex routes file
                $this->handler = $routes[$context]["controller"][$method];
            }
        }

        return $this->handler;
    }

}