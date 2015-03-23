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
//$handler = $router->match($request->server("REQUEST_URI"), $request->method());


//@todo Dispatcher seems obsolote here.
//Because the Base controller gets the $handler injected. injecting to basecontroller (again) is unnededed duplication.
//Prepare the send formation
//$dispatcher = new src\vendor\Webist\Dispatcher;
//$invoker = $dispatcher->handle($handler);

/*
 * $app = new app\Director; or app\BaseController and inject the $handler into it.
 * The main purpose is creating possiblity for any Controller to extend (at free will) the BaseController to have request_uri.
 * But this BaseController will contain also the model, permissions info.
 * So the Controller can better directly focus on the model without caring about the request or domain etc. E.g. $this->getModel();
 */
//var_dump($request, $router);

$app = new app\Dispatcher($request, $router);
$app->handle();



/**
 * @todo $request inject into the Director to share(reuse) with Controllers.
 * Injecting parameters to controller::method would be duplication. It is also cargo'ing data. So there is no need for it?
 * Only if the Controller (Manager) should not make use of a Director. Should the managers have this freedom?
 * Answer is yes.
 * Director signs contracts and let the manager do regulate things most of the time. Even if the Director is not on holiday.
 * So the solution should be something like if(Director involves) then (no need parameters) else (parameters).
 * When Director not involves then there is no model (no strategy, no plan, ..).
 * But the Director is not a regualtor (not a manager), so a good director writes Routes (actually builds the whole company) before any requests
 * are coming in.
 * As result the Director should write (cahce) and maintain routes with models in it. Not per each request.
 *
 * We still could discuss about a BaseController that should be shared by Controllers to get Permissions, but these also could be set in Routes.
 * But the controller would miss the request_uri value. Which is the $handler via
 * the Router (Router is director, so it would be ok if the router belongs to the Director/App)
 *
 *
 */

//Call in the method
//$invoker["reflectionMethod"]->invokeArgs($invoker["reflectionClass"]->newInstance(), [$request->parameters()]);

//test memory usage etc.
//$test = new src\vendor\Webist\Test;
//print $test->results();