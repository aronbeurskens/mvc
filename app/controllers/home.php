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

class home //extends \app\BaseController
{

    //@Notice, no constructor here. A controller is a ( Coordinator, Manager, Facilitator) for the others.
    //Controller itself does not really work.
    //It receives requests, requires permissions and sends tasks, not more.

    //@todo request can be better injected to higher level (shared) object.
    public function index()
    {



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

        //@todo there must be a way using \Request without duplicately calling it.
        $request = new \src\vendor\Webist\Request;

        $viewmodel =  new \app\models\view\model($request->server("REQUEST_URI"));

        //Prepare a view formation
        $template = new \app\views\Template;
        $path = $template->getPath("/frontend/index.php");
       //@todo paths should also defined/returned by model (Director)? So the model returns multiple include paths, $model->getPaths()?

        //Provide model to the View
        $view = new \src\vendor\Webist\View;
        $view->render($path, $viewmodel);
    }

}