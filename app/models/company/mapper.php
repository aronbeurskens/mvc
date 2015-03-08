<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name datamapper.php
 * @author Webist
 * Created at : Dec 25, 2014 9:40:18 AM
 * UTF-8
 *
 */

namespace app\models\company;

/**
 * Data Mapper for the storage.
 */
class mapper
{
    protected $data = array();

    public function addData($property, $data)
    {
        $this->data[$property] = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    // Get any value
    public function __get($key)
    {
        return array_key_exists($key, $this->data) ? $this->data[$key] : null;
    }

    // Set any value; leave out to make the data read only outside the class
    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

}