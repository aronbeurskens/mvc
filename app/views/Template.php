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


    /*
     * @todo templates juggle
     *
     * While Templates and View not really separated See more at: http://chadminick.com/articles/simple-php-template-engine.html#sthash.wp4WbTc8.dpuf
     * private $vars = array();
     * public function __get($name) { return $this->vars[$name]; }
     * public function __set($name, $value) { if($name == 'view_template_file') { throw new Exception("Cannot bind variable named 'view_template_file'"); }
     * $this->vars[$name] = $value; }
     */




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

        //@Notice returning the path only, not buffering the content.
        if (!file_exists($path)) {
            header("HTTP/1.0 404 Not Found.");
            $path = $this->dir() . "/frontend/page-404.php";
        }


        return $path;
    }
}