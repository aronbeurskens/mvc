<?php

/**
 * Project name: Webist MVC
 * @/webist/mvc
 * @name Router.php
 * @author Webist
 * Created at : Dec 22, 2014 9:45:03 AM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Request
{
    //path, query etc are part of the query.
    private $url = array("scheme" => NULL, "host" => NULL, "port" => NULL, "user" => NULL, "pass" => NULL, "path" => NULL, "query" => "", "fragment" => NULL);

    //http request method _GET, _POST, _REQUEST
    private $method = null;

    //
    private $parameters = null;

    /* not used, ....
    public function path()
    {
        if ($this->url["path"] === null) {
            $uri = trim(rtrim(array_values(explode("?", $this->server("REQUEST_URI")))[0], "/"), "/");
            // another way
            //$uri = explode('/', trim($this->server('PATH_INFO'), '/'));

            $this->url["path"] = explode('/', filter_var($uri, FILTER_SANITIZE_URL));
        }
        return $this->url["path"];
    }
     *
     */

    public function query()
    {
        //$uri = $this->requestUri();
        //CLI
        // parse_str(implode('&', array_slice(filter_input_array(INPUT_GET), 1)), $query);

        if ($this->url["query"] === null) {
            $this->url["query"] = $this->server("QUERY_STRING");
        }

        return $this->url["query"];

    }

    public function method()
    {

        if ($this->method === null) {
            $this->method = $this->server("REQUEST_METHOD");
        }
        return $this->method;
    }

    public function parameters($key = null)
    {
        $result = null;

        if ($this->parameters === null) {

            //PUT
            if ($this->method() === "PUT") {
                parse_str(file_get_contents('php://input'), $result);
            }

            //_POST
            if ($this->method() === "POST") {

                if ($key !== null && null !== ($param = $this->post($key))) {
                    $result = $param;
                }

                $result = ($result === null) ? filter_input_array(INPUT_POST) : $result;
            }

            //_GET
            if ($this->method() === "GET") {
                if ($key !== null && null !== ($param = $this->get($key) )) {
                    $result = explode('/', filter_var(rtrim($param, "/"), FILTER_SANITIZE_URL));
                }
                $result = ($result === null) ? filter_input_array(INPUT_GET) : $result;
            }

            $this->parameters = ($result === null) ? [] : $result;
        }

        return $this->parameters;
    }

    public function url()
    {
        return $this->url;
    }

    public function headers()
    {
        // @todo headers
        return getallheaders();
    }

    public function env($key)
    {
        return filter_input(INPUT_ENV, $key, FILTER_SANITIZE_STRING);
    }

    public function server($key)
    {
        return filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);
    }

    public function get($key)
    {
        //FILTER_SANITIZE_STRING : quotes are encoded
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
    }

    public function post($key)
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    public function cookie($key)
    {
        return filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_NUMBER_INT);
    }

}