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

namespace src\vendor\Webist;

/**
 * A partly role of a Director. Whom shares the routes, permissions etc.
 */
class Dispatcher
{
   // private $base;

   // public function __construct($base)
   // {
   //     $this->base = $base;
   // }

    public function handle($request, $router, $defaultAction = "index")
    {
        $handler = $router->match($request->server("REQUEST_URI"), $request->method());

        $matchClass = strstr($handler, '::', true);
        $class = ($matchClass === false) ? $handler : $matchClass;

        $macthAction = str_replace("::", "", strstr($handler, '::'));
        $action = ($macthAction === "") ? $defaultAction : $macthAction;

        //Set base
       // $this->base->setRequest($request);


        //$c = new $class;
        //@todo URL mapping.
        //When it is request object, when slug. This depends on defined route?
        //The fact that the controller can have Request
        //return $c->$action($request->parameters());

        /*
         * @todo get method and inject parameters/object. Check if an Object is already defined, otherwise pass parameters.
         *
         * $reflectionClass->hasMethod($action);
         * $reflectionClass->getMethod($action)->getParameters();
         */

        $reflectionClass = new \ReflectionClass($class);
        /**
         * having construct parses the request object as input.
         * Controller (Manager) is free to have __construct or not.
         * If does (being open to new ideas from this system = integration), then it gets request injected.
         * Furthermore controller can extend BaseController (to get .. what?)
         */
        //if($reflectionClass->hasMethod("__construct")){


            /**
             * @Notice we force every controller (manager) to have input via construct.
             * It is difficult to imagine to have a controller without input.
             * symfony allows (not forces) to inject into the method/action alongside parameters, but
             * that is after the magic they've done in their baseController, so people will use their FrameWork.
             *
             * Actually the BaseController should not influence the request.
             * Therefore we call it Base, not BaseController.
             */
            $class = $reflectionClass->newInstance($request);


        //} else {
         //   $class = $reflectionClass->newInstance();
        //}

        $reflectionMethod = new \ReflectionMethod($class, $action);
        return $reflectionMethod->invokeArgs($class, [$request->parameters()]);



        /**----------------- todo better parsing request and parameters

        $cs = get_declared_classes();
        //print_r($cs);
        $currentClasses = [];
        foreach($cs as $class){

            //strpos($cs, $class);
            //preg_match('`.*\s\(?in([^\)]+)\)?$`i', );
            $pos = strrpos($class, '\\');
            if($pos !== false) {
                $currentClasses[strtolower(substr($class, $pos + 1))] = true;
            } else {
                $currentClasses[strtolower($class)] = true;
            }
            //preg_match("/ [^ ]+$/",$string);
            //$currentClasses[strstr($class,"\\")] = true;
        }

       // print_r($currentClasses);
        //read the constructor and meet the injection

        $reflectionClassConstructParameters = $reflectionClass->getConstructor()->getParameters();

        foreach($reflectionClassConstructParameters as $reflectionParameter) {

            //class was defined, so we can accept the constructor injection.
            if(isset($currentClasses[$reflectionParameter->name])) {

            }

            //if($reflectionParameter->name == "request"){
            //    $request = true;
            //}
            // src\vendor\Webist\Request
            //var_dump($reflectionClass->getConstructor()->);

            //if(in_array($reflectionParameter->name, )) {
            //    var_dump("matched");
            //}

        }
        /**/


    }

}