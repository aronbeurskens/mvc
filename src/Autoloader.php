<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name Autoloader.php
 * @author Webist
 * Created at : Dec 27, 2014 10:19:45 AM
 * UTF-8
 *
 */
class Autoloader
{
    //is PHP auto-free-up memory for private variables? We could test this by loading huge data into.
    //private variable cannot be used outside, so it makes sense to free-up memory. When the object re-used the private var could be reloaded.
    private $paths = [];



    /**
     *
     * @param type $vendordir, vendor directory is the fullpath that will be used inA APache as wel as in CLI mode
     */
    public function __construct()
    {
        $this->setPaths();
        spl_autoload_register(array($this, 'loader'));
    }

    public function addPath($path)
    {

        if (!in_array($path, $this->paths)) {
            $this->paths[] = $path;
        }
    }

    private function setPaths()
    {
        return $this->paths = explode(PATH_SEPARATOR, get_include_path());
    }

    public function getPaths()
    {
        return $this->paths;
    }
   /**
    private $request = null
    public function setRequest($request){

        if($this->request === null){
            $this->request = $request;
        }
        return $this->request;
    }

    public function getRequest(){

        return $this->request;
    }
    *
    */

    private function isFile($class){
        $file = false;
            foreach ($this->paths as $path) {
                $try = str_replace("\\", DIRECTORY_SEPARATOR, $path) . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';
                if (is_file($try)) {
                    $file = $try;
                    break;
                }
            }
            return $file;
    }

    private function loader($class)
    {
        try {

            $file = $this->isFile($class);

            if ($file) {
                require_once $file;
            } else {
                throw new \Exception(debug_print_backtrace());
            }
        } catch (\Exception $e) {
            print "Caught exception: " . $e->getMessage() . " @Notice: Lower or Upper case directory and/or file names are frequent problem.";
        }
    }

}