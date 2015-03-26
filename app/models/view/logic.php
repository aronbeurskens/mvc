<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name controller.php
 * @author Webist
 * Created at : Dec 25, 2014 9:39:09 AM
 * UTF-8
 *
 */

namespace app\models\view;

/**
 * Domain Object or Business Logic
 * This layer coordinates the application, process commands, makes logical desicions and evaluations,
 * and performs calculations.
 * It also moves and processes data between the two surrounding layers (view, mapper).
 *
 * @Question this class should be only called from \view\service object. How to
 * protect this object while I am using Dependency Injection?
 *
 */
//in DDD terms : The Entity. It could have a never changing Id property and not built by its attributes.
//Since it is view\logic or view\entity the Id would be viewId. With this created an unique object.
//Just like identifying a seat in airplane seat\entity or identifying the user user\entity by id.
//
class logic
{


    //data holder, normally each (http) request build and hold data (in memory) to serve
    private $data = [];

    //selects from data by given key.
    private $selection = "";

    //Wouldn't the methods here not SETTERs instead of getters?
    //Because here we should "allow" or route the interaction between
    //the client(view[html]\service) and server(view[data]\mapper).
    public function getData($property, $context, $select)
    {
        //var_dump($property, $context, $select);//page / title
/************** todo repository tasks *************************/


        //page might have different context
        if ($property == "page") {

            $this->data[$property] = $this->getPageData();

            if (is_callable(array(__CLASS__, "selectPage"))) {
            call_user_func_array(array(__CLASS__, "selectPage"), array($property, $context, $select));
            }
        }

        //comes from file
        if ($property == "corporate") {
            $this->data[$property] = $this->getCorporateData();

            if (is_callable(array(__CLASS__, "selectCorporate"))) {
            call_user_func_array(array(__CLASS__, "selectCorporate"), array($property, $select));
            }
        }

        //comes from database or cache (not yet)
        if ($property == "navigation") {
            $this->data[$property] = [
                "{$property}" => [
                    //TODO here smells to creating a new model like navigationService(navigationLogic, navigationMapper)
                    //$element == header
                    "header" => $this->buildTree($this->reIndexArray($this->getNavigationHeaderData()))
                ]
            ];

              if (is_callable(array(__CLASS__, "selectNavigation"))) {
                call_user_func_array(array(__CLASS__, "selectNavigation"), array($property, $select));
            }
        }
/********************* end repository tasks ********************************************/

        return $this->selection;
    }

    private function selectPage($property, $context, $element)
    {
       //var_dump($property, $context, $element);
       //print_r($this->data);

        if ($element === null) {
            $this->selection = implode(" ", $this->data[$property][$property]);
        } else {
             if(!isset($this->data[$property][$context])){
                 $this->selection = "Not found";
             } else {
                 $this->selection = $this->data[$property][$context][$element];
             }

        }
        return $this->selection;
    }

    private function selectCorporate($property, $element)
    {
        //var_dump($property, $element);
        //print_r($this->data);
        if ($element === null) {
            $this->selection = implode(" ", $this->data[$property]);
        } else {
            $this->selection = $this->data[$property][$element];
        }
        return $this->selection;
    }
        private function selectNavigation($property, $element)
    {
        if ($element === null) {
            $this->selection = implode(" ", $this->data[$property][$property]);
        } else {
            $this->selection = $this->data[$property][$property][$element];
        }
        return $this->selection;
    }



    private function getPageData()
    {

        $result = null;
        //@Notice, a missing resource should not generate a blocking error.
        $file = "../data/indexes/page.php";
        if (file_exists($file)) {
            $result = include $file;
        }
        return $result["page"];//[$context];
    }

    private function getCorporateData()
    {
        $result = null;
        //@Notice, a missing resource should not generate a blocking error.
        $file = "../data/indexes/corporate.php";
        if (file_exists($file)) {
            $result = include $file;
        }
        return $result['corporate'];
    }

    private function getNavigationHeaderData()
    {
//TODO it is better to have separete file for every server/db config. production, dev includes same file but it contains different params.
        $link = ["sqldatabase" => [
                "server" => "local",
                "database" => "nav",
                "sql" => "SELECT * FROM tree WHERE 1 "
        ]];

        $config = new \src\vendor\Webist\Config;

        //Always catch a resource connection.
        try {

            $servers = $config->getServers("../app/config/servers.json");
            if (false === $servers) {
                throw new \Exception("Could not get servers configuration to connect the database");
            }

            //Always catch a resource connection.
            try {

                $connector = new \src\vendor\Webist\Connector($servers, null);

                $pdo = $connector->connectWith($link["sqldatabase"]["server"])
                    ->withDatabase($link["sqldatabase"]["database"])
                    ->getPdo();

                $st = $pdo->prepare($link["sqldatabase"]["sql"]);
                $st->execute();
                $result = $st->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {

                $message = $e->getMessage() . " File " . __FILE__ . " Line " . __LINE__;
                // send error somewhere to have sufficient info.
                error_log($message);
            }
        } catch (\Exception $e) {

            $message = $e->getMessage() . " File " . __FILE__ . " Line " . __LINE__;
            // send error somewhere to have sufficient info.
            error_log($message);
        }

        return isset($result) ? $result : [];
    }

    private function reIndexArray($arr, $indexColumn = "id")
    {
        $indexed = [];
        foreach ($arr as $v) {
            $indexed[$v[$indexColumn]] = $v;
        }
        return $indexed;
    }

    private function buildTree(array &$elements, $parentId = 1)
    {
        $branch = array();

        foreach ($elements as $element) {

            if ($element['parentId'] == $parentId) {

                $children = $this->buildTree($elements, $element['id']);

                if ($children) {
                    $element['children'] = $children;
                } else {
                    //var_dump($element);
                }
                $branch[$element['id']] = $element;
                //var_dump($elements[$element['id']]);
                //unset($elements[$element['id']]);
            } else {
                // var_dump($element);
            }
        }
        return $branch;
    }

}