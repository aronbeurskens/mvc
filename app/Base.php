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

//use \src\vendor\Webist\Request;
//use \src\vendor\Webist\Router;
use \app\models\view\model;
use \app\views\Template;
use \src\vendor\Webist\View;

/**
 * //Service container, the App model.
 * This BaseController defines which handler to load or not.
 */
class Base
{
    //private $declared = [];
    //public function setRequest($reference){
    //    $this->request = $reference;
    //}

    //private $request = null;

    //public function __construct()
    //{
        //so I  do n
        //var_dump("Base re-called").  debug_print_backtrace();
    //}

    /**
    public function getRequest()
    {
        if ($this->request === null) {

            //@todo, when request comes from a controller, like home, then it is null.
            //Find out, how this forgotten in the flow. (see the problem $this->getRequest(), instead of this->request)
            //Reflection, callback, the scope is only the autoloader, should we still inject the request?
            //var_dump("Request was null, will be re-called").  debug_print_backtrace();

            //I believe the Dispatcher must be within the Base object and not freeley.
            //So I do not callback via Reflection?
            //Forcing every controller to construct? A manager should always construct the request?
            //Probably it is. It is his input. No input = no action makes sense.
            //But the frameworks like to control this input by themselves. so they do not force to user to use construct.

            $this->request = new Request;
        }
        return $this->request;
    }
     *
     *
     */

    public function getRouter()
    {
        //return new Router;
    }

    public function getModel($requestUri, $type = "view")
    {
        $model = null;
        if ($type == "view") {
            $model = new model($requestUri);
        }
        return $model;
    }

    public function getTemplate()
    {
        return new Template;
    }

    public function getView()
    {
        return new View;
    }

    public function bind($object, $callback)
    {
        # ....
    }

    /**
     * @todo (container [reference container]) that constructs and returns the requested object.
     * When a service-object was defined, but never used must never created. (Lazy loading).
     *
     */
    public function get($callback)
    {

        //template, router, mailer, ... etc.
        #if (!is_callable($callback)) {
        # throw new InvalidArgumentException('Paran must be callable.');
        #}
        #$callback = $callback->bindTo($this);
        #$callback();
        //if($callback == "view"){
        //    return new app\models\view\model($this->request->server("REQUEST_URI"));
        //}
    }


}