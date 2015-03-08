<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name Config.php
 * @author Webist
 * Created at : Dec 31, 2014 5:03:27 PM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Config
{

    public function getServers($file)
    {

        //@Notice, a missing resource should not generate a blocking error.

        if (\file_exists($file)) {
            $result = \json_decode(\file_get_contents($file), true);
        }
        return isset($result) ? $result : false;
    }

}