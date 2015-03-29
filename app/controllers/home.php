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

/**
 * Coordinating Controller
 *
 * Coordinating controllers oversee and manage the functioning of an entire application, or part of one.
 * They are often the places where application-specific logic is injected into the application.
 * A coordinating controller fulfills a variety of functions, including:
 * - Responding to delegation messages and observing notifications
 * - Responding to action messages (which are are sent by controls such as buttons when users tap or click them)
 * - Establishing connections between objects and performing other setup tasks, such as when the application launches
 * - Managing the life cycle of “owned” objects
 *
 */
class home extends \app\base\Controller
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function index()
    {
        //Prepare Model (or Service Container) by letting the base\Controller match the model within the current request context
        $model = $this->getModel($this->request->server("REQUEST_URI"), "view");

        //Prepare a view formation
        $template = $this->getTemplate();
        $path = $template->getPath("/frontend/index.php");

        //Provide model to the View
        $view = $this->getView();
        $view->render($path, $model);
    }

}