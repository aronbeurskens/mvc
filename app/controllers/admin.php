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
use app\Base;

class admin extends Base
{

    private $request;

    public function __construct($request)
    {
          $this->request = $request;
    }

    public function index()
    {
        /**
         *
        //@Tip, ask yourself. Why a Controller should have more than 3 objects? Does it make sense?

        //$model = $this->model("view", $request->server("REQUEST_URI"));
        //
        //@todo there must be a way using \Request without duplicately calling it.
        $request = new \src\vendor\Webist\Request;

        $viewmodel =  new \app\models\view\model($request->server("REQUEST_URI"));


        $template = new \app\views\Template;
        $path = $template->getPath("/admin/index.html");


        $view = new \src\vendor\Webist\View;
        $view->render($path, $viewmodel);
        */

        //Prepare Model (or Service Container) by letting the Base match the model within the current request context
        $viewmodel = $this->getModel($this->request->server("REQUEST_URI"), "view");

        //Prepare a view formation
        $template = $this->getTemplate();
        $path = $template->getPath("/admin/index.html");

        //Provide model to the view
        $view = $this->getView();
        $view->render($path, $viewmodel);


    }

}