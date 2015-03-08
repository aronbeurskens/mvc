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

namespace app\models\view;

/**
 * Data Mapper for the storage.
 * Typical functions are find, delete, findAdd, insert, update etc.
 * This where parsing SQL/XML to database/files lives.
 *
 * @Question this class should be only called from \view\service object. How to
 * protect this object while I am using Dependency Injection?
 *
 */
//in DDD terms we should call this the Value object. Contains attributes of view in view\value space. Immutable.
// Example value of the money, not the id of paper. The seat with attributes.
// mapper (value) object might use Repository
class mapper
{

    protected $data = array();

    //public function addData($property, $data)
    //{
    //    $this->data[$property] = $data;
    //}

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