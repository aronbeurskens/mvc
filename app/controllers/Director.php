<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name Director.php
 * @author Webist
 * Created at : Mar 3, 2015 9:01:01 AM
 * UTF-8
 *
 */

namespace app\controllers;

class Director
{
    /**
     * Director is the Controller of Controllers of the organization.
     *
     * - listen/accept request context (buy=post req, sell=get req)
     * - define strategy (define a choice from available alternatives) within the app
     * for result (page, response [product]) and context (market).
     *
     * - permit a procedure by sign. So listen to request and the way of work-flow (process, design-pattern?).
     * For instance using PDO tool permission.
     *
     * - watch/control and create capacity (budget) some time. Lets say every 3 days.
     * But this can be also triggered by a big request. So every new route item (in routes file) should cause
     * checking capacity check. And a new route should be added/removed by the director, not the programmer.
     * Adding/Removing a route item should be caused by the ....
     *
     * - negotiation and contraction with services. Like web services that delivers data but also services
     * those accepts output and delivers to their requests (api client & api server).
     *
     * - market watch. competetions (how much a tool is liked) and opportunities (new package check).
     *
     * - re-orginize workers and managers. (managers(controllers) should not be generated manually, but by the Director?)
     *
     * - periodical analyse by communicating the workers, managers.
     *
     * - represent the app on platforms and making introduction to others (composer image?)
     *
     * - maintain tools by repairing, buying
     *
     * - analyse app prestations by evaluations
     *
     *
     *
     * MODEL : which model to use.
     * - define context
     * - hires a mapper (planner)
     * - delegate (responsibility) Logic to a worker and let it cooperate with mapper
     * The Model that choosed by the director takes care of product (page) data, translations, navigation, logs, etc.
     *
     * TEMPLATE : which template/response to use. A template can be located at external place. front-end development.
     *
     * VIEW : Making model available(connect things) to Response generator (template).
     *
     *
     * @todo Director tasks. Pretty much every class that would normally needed from the \app\core directory.
     * //set model
     * model = Model("view")->entity('request_uri');
     *
     * //set template
     * path = Template()->path("/");
     *
     * //set view
     * View()->render(path,model);
     *
     *
     *
     *
     *
     *
     */
    //@todo ModelMapper object
    private $modelMap = [
        "view" => [
            //@Notice namespaces cannot have variables, which is good for consistent interfacing.
            "model" => "\\app\\models\\view\\model",
            "logic" => "\\app\\models\\view\\logic",
            "mapper" => "\\app\\models\\view\\mapper"
        ]
    ];

    public function model($model, $context = null)
    {
        /*
         * in the simpliest way we would do this
         * include "models/{$model}.php
         * So, only direction.
         *
         *
         */

        /* a research how to structure a model
         * http://stackoverflow.com/questions/5863870/how-should-a-model-be-structured-in-mvc
         * (contact this guy and show the github dir)
         *
         * Model = Layer = Organisation of programming into separate functional components
         * that interact in some sequential and hieracrhial way, with each layer usually having an interface only to the layer
         * above it and the layer below it. (interfaces define the connection between the layers).
         * A model can be build of n layers. For example TCP/IP two layers. 1. provide transport 2. provide network adress.
         * Model != Single Class
         * Model != Single Object
         * Model != ORM technique
         * Model != abstraction of db tables
         *
         *
         * 1. Domain Object(s) `structures/layers`
         * Domain info container.
         * Represents Entity business. (Business logic).
         * Validates or gives the instructions how to validate (data, ...). Notice dataMapper(is a worker) validate things for own funtionality, Director does not validate those.
         * Gives permissions
         * Computes costs (memory ...)
         *
         * Not aware of Storage, SQL Database, Rest API, Text File, etc). Even those resources are get saved or retrieved.
         *
         * In a company organization context the tasks of a Director (role),
         * whom comminicates mostly with Managers, can be seen as domain object tasks.
         *
         * 2. Data Mappers, Repository `resources`
         * Parses storage data from (SQL, XML, file, ..) from and to resources.
         * For example Query execution is not a task of a Manager or Director. Query execution is the task of a Worker.
         * Mostly Manager requires a Worker from the Director (and the Director ModelMaps/...)
         * and Manager can comminicate directly (not via the Director per se) with the Woker.
         * For example $this->model("product")->finder("Foo");
         *
         * 3. Services, higher domain level objects `objects`
         * Allows access to the model layer.
         * Interacts Domain Objects and Mappers (descriptors)
         * Services are public to the Domain Object(s)/Business logic.
         *
         * Interacting with a model
         * Controller of the MVC should only comminicate trough Services.
         * Director provides a ServiceFactory here.
         * Director neither Worker know beforehand what kind of items they will be making.
         *
         * //I am not ok with this Factory thing yet.
         * The Factory Method design pattern can be applied where the Worker does not know beforehand which component should be called at runtime.
         * Factory within this (Director) context.
         * The Director maps to any Service. Which service can be defined in a map. So Mapping and Factory method solves the same problem?
         * When there is need for subclasses, the Mapping might get complex?
         * A class that builds via fluent interface actually a factory object?
         *
         *
         * //basic structure of model layer, is created by Director.
         * $serviceFactory = new ServiceFactory(
         *  new DataMapperFactory($pdo),
         *  new DomainObjectFactory
         * );
         * $serviceFactory->setDefaultNamespace('Application\\Service');
         *
         *
         *
         */
        //possible values
        //private $repository;
                //private $adapter; //maybe only need for the Director self.
        //private $permissions;//authentication
                //users and roles
        //private $services;
                //privte $package
        //private $workers; //not process-workers per se, but whom can be make available for executing a task. Chain of Resp here? http://en.wikipedia.org/wiki/Chain-of-responsibility_pattern
                  //private $sanitizer;
                  //private $commands
        ////private $strategy; //supports a strategy to managers
        //private $observer; //make an observer available
        //private $logger;

        //private $decorator;


        //Zie ook Jeffrey Way, Laracon, Laracasts.com

        //@todo map to (Factory to) Service(s) and call them here. Services-call only here.

        //@Notice, having model,logic,view or not to return a module is completely in the control of the director. This allows us to make future improvements.

        return new $this->modelMap[$model]['model']( //this one should be Service like thing.

            $context, //input for the Director is where to look at (which scope) that given by request.

            new $this->modelMap[$model]['mapper'](), //Context for the Director itself. DataMapperFactory or Repository? Obviously he could map to db and make the correct db available.

            new $this->modelMap[$model]['logic']() //DomainObjectFactory. Make here the calc, modifications etc.



        );

        /*
         * Example user Service
         *
         * $account = $this->domainObjectFactory("user");
         * $mapper = $this->dataMapperFactory("user");
         *
         * $mapper->fetch($account);
         *
         * So, the $context = "user" seems shared here.
         *
         */

        /*
         * Rerpository might need to collect data from multiple resources. E.g. File, Database.
         * The DomainObject will then collect these.
         *
         *
         */

        /**
         * Triad according to DDD.
         * Entity : When an object can change it’s attributes but remain the same object we call it an Entity. E.g. Person. http://culttt.com/2014/04/30/difference-entities-value-objects/
         * Value Object : e.g. Location. must be possible to create multiple.
         *
         */


    }

}