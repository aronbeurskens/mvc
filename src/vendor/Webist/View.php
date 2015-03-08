<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name View.php
 * @author Webist
 * Created at : Feb 28, 2015 10:09:00 PM
 * UTF-8
 *
 */
namespace src\vendor\Webist;

class View {

    public function render($path, $model)
    {
        include $path;
    }
}