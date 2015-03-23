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

class notfound //extends \app\BaseController
{

    public function index()
    {

        //print_r($this);

        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //Prepare Model by letting the Director match the model within the current request context
        //$model = $this->model("view", $request->server("REQUEST_URI"));


        //@todo there must be a way using \Request without duplicately calling it.
        $request = new \src\vendor\Webist\Request;

        $viewmodel =  new \app\models\view\model($request->server("REQUEST_URI"));

        //Prepare a view formation
        $template = new \app\views\Template;
        $path = $template->getPath("/notfound/index.php");

        //Provide model to the view
        $view = new \src\vendor\Webist\View;
        $view->render($path, $viewmodel);
    }

}