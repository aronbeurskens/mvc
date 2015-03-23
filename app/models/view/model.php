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

/**
 * @todo
 */
class model
{

    private $context;

    private $logic;
    private $mapper;

    public function __construct($context)
    {
        /**$context, logic $logic, mapper $mapper
         * @Notice, there is no need for injection here.
         * Because this is the access object to the Services of this model/package.
         * We should think in the context of start() [construct/build], stop(), restart() here.
         * So this object should be facade-, compostion-like build.
         *
         * Decorator : attaches additional responsibilities to an object dynamically.
         *             Decorators provide a flexible alternative to subclassing for extending fuctionality.
         *             Open for extension, but close for modification. Modification happens internally in th object.
         *             This is memory costly $this stack, wraps thins, but useful for config file[pre-defined constants, so no need to modify], loggin output etc.
         *
         * Composite : Collection of objects.
         *             Useful for data structures (e.g. hierachial).
         *             e.g. Search tree (xml etc) with iterator pattern.
         *             Visitor patterns to build the composite (add new functionality)
         *             This might lead to CPU-costly recursion.
         *
         * Facade    : provides a unified interface to a set of interfaces in a subsystem..
         *             Facade defines a higher level interface that makes the subsystem easier to use
         *             A request passed to other objects withhou making changes to others.
         *             Facad is not an Adapter, Facade does not require to use certain interface, while Adopter does.
         *
         */

        $this->context = $context;
        //$this->logic = $logic;
       // $this->mapper = $mapper;
        //$this->build();

        $this->logic =  new \app\models\view\logic;
        $this->maper =  new \app\models\view\mapper;
    }

    private function build(){
        //@todo $this->build(), build here factories.
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