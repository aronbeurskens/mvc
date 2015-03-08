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

namespace app\models\view;

/**
 * Interaction between Domain Objects and Mappers
 * The basic idea is first set/validate config in logic object and get/fetch from mapper object.
 * For example the logic might to decide deliver data from an XML file.
 *
 * @alert, public functions here for interacting with the domain business logic.
 * Avoiding them results of leaking domain logic into
 * Controllers (Managers, and managers should not know how things work
 * but only faciliate tooling/comminication between the specialists.
 * For example a manager can check the current status of object A
 * to give response back (to the http request) or validates the request or delegates
 * a long running task to other workers.
 * )
 *
 */
//in DDD terms : aggregate. collection of objects in view\root space. Example: implement here Car object.
// when you drive car, you do not care moving wheels, but only drinving the car.
class model
{

    private $context;

    private $logic;
    private $mapper;

    public function __construct($context, logic $logic, mapper $mapper)
    {
        $this->context = $context;
        $this->logic = $logic;
        $this->mapper = $mapper;
    }

    public function query($property, $callback = null) //page, title
    {

        /**
         * TODO use logic as Id (entity) and according to ID get data from mapper (Value object)
         *
         * $this->Id = new \view\entity($property); //scope/context definer: page
         * $this->Value = new \view\value($this->Id, $callback); // return the attribute: title
         *
         * return $this->Value;
         */
        return $this->logic->getData($property, $this->context, $callback);
    }

}