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

class notfound extends \src\vendor\Webist\Director
{

    public function index($request)
    {

        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //Prepare Model by letting the Director match the model within the current request context
        $model = $this->model("view", $request->server("REQUEST_URI"));

        //Prepare a view formation
        $template = new \app\views\Template;
        $path = $template->getPath("/notfound/index.php");

        //Provide model to the view
        $view = new \src\vendor\Webist\View;
        $view->render($path, $model);
    }

}