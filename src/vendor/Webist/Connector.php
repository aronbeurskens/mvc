<?php

namespace src\vendor\Webist;

class Connector
{
    private $servers = [];
    private $serverSelection;
    private $databaseSelection;
    private $portSelection;
    private $logger;

    public function __construct(array $servers, $logger)
    {
        $this->servers = $servers;
        $this->logger = $logger;
    }

    public function addServer($key, $tcp, $host, $user, $password = null)
    {
        $this->servers[$key] = [
            'tcp' => $tcp,
            'host' => $host,
            'user' => $user,
            'password' => $password
        ];

        return $this;
    }

    public function connectWith($key)
    {
        //@Notice, A resource will be always try, catched.
        if (isset($this->servers[$key])) {
            $this->serverSelection = $this->servers[$key];
        }
        return $this;
    }

    public function withDatabase($name)
    {
        $this->databaseSelection = $name;

        return $this;
    }

    public function onPort($port)
    {
        $this->portSelection = $port;

        return $this;
    }

    public function getPdo()
    {

        try {
            $dsn = $this->serverSelection['tcp'] . ":host=" . $this->serverSelection['host'];

            //NULL means !isset()
            if (isset($this->databaseSelection)) {
                $dsn .= ';dbname=' . $this->databaseSelection;
            }

            //NULL means !isset()
            if (isset($this->portSelection)) {
                $dsn .= ';port=' . $this->portSelection;
            }

            $pdo = new \PDO($dsn, $this->serverSelection['user'], $this->serverSelection['password'], [
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            ]);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {

            //@Notice, a missing resource should not generate a blocking error.
            throw $e;
        }

        // unset the fluent interface selection
        unset($this->serverSelection, $this->databaseSelection, $this->portSelection);

        return $pdo;
    }

}