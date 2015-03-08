<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name index.php
 * @author Webist
 * Created at : Dec 21, 2014 1:53:05 PM
 * UTF-8
 *
 * test post data
 * print "<form method=post><input type=text name=xx value=11><input type=submit></form>";
 */

require_once "../src/Autoloader.php";
$autoloader = new Autoloader;
//we are in public dir. One-up to be able to load (non-public) app files.
$autoloader->addPath(dirname(__DIR__));

//Add document_root for both http and cli environments
$argc = filter_input(INPUT_SERVER, 'argc', FILTER_SANITIZE_STRING);
define("DOCROOT", str_replace("\\", DIRECTORY_SEPARATOR, ((((((isset($argc) ? $argc : null) >= 1) === true)
    ? PHP_SAPI : "apache") == "cli") ? dirname(__FILE__) : getcwd())));
$autoloader->addPath(DOCROOT);

//Prepare the input reads
$request = new src\vendor\Webist\Request;

//Prepare Handler by letting the Router match the request with a pre-defined route
$router = new src\vendor\Webist\Router;
$handler = $router->match($request->server("REQUEST_URI"), $request->method());

//Prepare the send formation
$dispatcher = new src\vendor\Webist\Dispatcher;
$invoker = $dispatcher->handle($handler);

//Call in the method
$invoker["reflectionMethod"]->invokeArgs($invoker["reflectionClass"]->newInstance(), [$request]);

//test memory usage etc.
//$test = new app\core\Test;
//print $test->results();