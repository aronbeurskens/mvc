<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name App.php
 * @author Webist
 * Created at : Dec 21, 2014 1:54:21 PM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Controller 
{
    /*
     * Surprised by empty Core App object?
     * Let me tell you the truth. There is no such a thing like framework.
     * As long as an object is not a part of a model that forms a component like service it should be independent.
     *
     * When all these independent objects comes in play?
     * The answer is models. Those quickly getting fat models should benefit the objects like
     * Logger, Connector, QueryBuilder, Request etc.
     *
     * The object oriented world is much like real world (did I say no frameworks).
     * There are all size of companies built with all kind of relations to serve mostly a single purpose.
     * There are also many freelancers whom take off all the bloats caused by relations
     * and so dependencies within the bigger organizations.
     *
     */

    //@Notice, we dont prefer loading/injecting objects into other objects, but require from the client object to maket it born into.
    //public $request = null;

}