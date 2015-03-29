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

class notfound extends \app\base\Controller
{

    private $request;


    public function __construct($request)
    {
          $this->request = $request;
    }

    public function index()
    {

        //Prepare Model (or Service Container) by letting the base\Controller match the model within the current request context
        $viewmodel = $this->getModel($this->request->server("REQUEST_URI"), "view");

        //Prepare a view formation
        $template = $this->getTemplate();
        $path = $template->getPath("/notfound/index.php");

        //Provide model to the view
        $view = $this->getView();
        $view->render($path, $viewmodel);
    }

}