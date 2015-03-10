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

    //@todo addTemplate (paths not content = that is the challenge) and juggle those.
    //For example a widget that should be included into current main (index.php) template file.
    //so $model->query("widget","polling"); should be managed by model (async?) to have include, within include.

    public function render($path, $model)
    {
        include $path;
    }
}