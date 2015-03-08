<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name service.php
 * @author Webist
 * Created at : Dec 26, 2014 10:05:32 AM
 * UTF-8
 *
 */

namespace app\models\company;

/**
 * Interaction between Domain Objects and Mappers
 */
class model
{
    private $logic;
    private $mapper;

    public function __construct($logic, $mapper)
    {
        $this->logic = $logic;
        $this->mapper = $mapper;
    }

    public function query($property)
    {
        if (!isset($this->mapper->getData()[$property])) {
            $this->set($property);
        }

        return $this->mapper->{$property};
    }

    private function set($property){

        $this->mapper->addData($property, $this->logic->getData($property));
        return true;
    }
}