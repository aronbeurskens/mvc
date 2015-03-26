<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name Home.php
 * @author Webist
 * Created at : Dec 21, 2014 2:04:52 PM
 * UTF-8
 *
 */



namespace app\controllers;
use app\Base;

//print_r($this); //Autoloader Object
//@todo $this can be better the Base object. Then there would be no need for duplication of request.

class home extends Base
{

    //@Notice, no context here. A controller is a ( Coordinator, Manager, Facilitator) for the others.
    //Controller itself does not really work and has no context injected. Instead builds the context.
    //It receives requests, requires permissions and sends tasks, not more.

    private $request;

        /**
     * ($$request, $base) should every controller also injected the Base-context?
     * When the Base is injected, then looks like a free manager that uses eventaully $this->base
     * When the Base is extended, then manager by using $this-> mounted to Base and has not much choice. Which looks more correct here.
     * So a base is a platform, not helper, which should be extended not injected.
     * @param type $request
     */
    public function __construct($request)
    {
          $this->request = $request;
    }


    //@todo request can be better injected to higher level (shared) object.
    public function index()
    {

      //var_dump($this);

        //@todo there must be a way using \Request without duplicately calling it.
       //$this->request = new \src\vendor\Webist\Request;

        //@Notice, since we the request only needed for selecting the right model, we do not need here anymore.
       # $this->request = $this->getRequest();//so controller extends actually the call-centre/reception.

        //@Alert, do not call modules here. A module should be the part of a model directed by the Director object.
        //calling Services via Director also should be a better practice.
        //For example Repository is a part of the model and should not be directly called from here,
        //but after the model mapping.
        //E.g. better is $model->repository()->find("product", "Foo");
        //instead of $repository = $this->model("product")->finder("Foo");

        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //Prepare Model by letting the Director match the model within the current request context
        #$model = $this->model("view", $request->server("REQUEST_URI"));
        //$viewmodel = $this->getModel("view");

        //$viewmodel =  new \app\models\view\model($this->request->server("REQUEST_URI"));
        $viewmodel = $this->getModel($this->request->server("REQUEST_URI"), "view");

        //Prepare a view formation
        //$template = new \app\views\Template;
        $template = $this->getTemplate();
        $path = $template->getPath("/frontend/index.php");
       //@todo paths should also defined/returned by model (Director)? So the model returns multiple include paths, $model->getPaths()?

        //Provide model to the View
        //$view = new \src\vendor\Webist\View;
        $view = $this->getView();
        $view->render($path, $viewmodel);
    }

}