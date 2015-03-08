<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name admin.php
 * @author Webist
 * Created at : Dec 22, 2014 6:09:58 PM
 * UTF-8
 *
 */

namespace app\controllers;

class admin extends Director
{

    public function index($request)
    {
        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //Prepare Model by letting the Director match the model within the current request context
        $model = $this->model("view", $request->server("REQUEST_URI"));

        //Prepare a view formation
        $template = new \app\views\Template;
        $path = $template->getPath("/admin/index.html");

        //Provide model to the view
        $view = new \src\vendor\Webist\View;
        $view->render($path, $model);
    }

}