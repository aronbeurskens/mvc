<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name View.php
 * @author Webist
 * Created at : Feb 28, 2015 10:09:00 PM
 * UTF-8
 *
 */

namespace app\base;

class View
{
    function render($path, $model)
    {
        include $path;
    }

}