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

class home extends \src\vendor\Webist\Director
{

    //@Notice, no constructor here. A controller is a ( Coordinator, Manager, Facilitator) for the others.
    //Controller itself does not really work.
    //It receives requests, requires permissions and sends tasks, not more.

    public function index($request)
    {

        //@Alert, do not call modules here. A module should be the part of a model directed by the Director object.
        //calling Services via Director also should be a better practice.
        //For example Repository is a part of the model and should not be directly called from here,
        //but after the model mapping.
        //E.g. better is $model->repository()->find("product", "Foo");
        //instead of $repository = $this->model("product")->finder("Foo");

        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //Prepare Model by letting the Director match the model within the current request context
        $model = $this->model("view", $request->server("REQUEST_URI"));

        //Prepare a view formation
        $template = new \app\views\Template;
        $path = $template->getPath("/frontend/index.php");

        //Provide model to the View
        $view = new \src\vendor\Webist\View;
        $view->render($path, $model);
    }

}