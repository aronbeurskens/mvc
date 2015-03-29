<?php

/**
 * Project name: Webist MVC
 * @package
 * @name BaseController.php
 * @author Webist
 * Created at : Mar 19, 2015 11:27:43 AM
 * UTF-8
 *
 */

namespace app\base;

class Controller
{

    public function getModel($requestUri, $context = "view")
    {
        $model = null;
        if ($context == "view") {
            $model = new \app\models\view\model($requestUri);
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

}