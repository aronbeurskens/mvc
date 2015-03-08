<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name Template.php
 * @author Webist
 * Created at : Feb 28, 2015 8:56:51 PM
 * UTF-8
 *
 */

/**
 * @Notice, Template object will not need a set with auto magic vars, extract vars etc.
 * Our template is a resource handler only, as it should be.
 * It does not carry/cargo data (the whole app never carry/cargo data, wel almost all) and has not construct.
 * A construct is too frequently loading data into the object. If not needed, then leave it.
 */

namespace app\views;

class Template {

    //default template directory
    private $dir = null;

    private function dir(){

        if($this->dir === null){
            $this->dir = dirname(dirname(dirname(DOCROOT)))
            . "/frontend.local/public_html/metronic_v3.6.2/theme/templates";
        }
        return $this->dir;
    }

    public function getPath($file){

        $path = $this->dir() . $file;

        if (!file_exists($path)) {
            header("HTTP/1.0 404 Not Found.");
            $path = $this->dir() . "/frontend/page-404.php";
        }

        return $path;
    }
}