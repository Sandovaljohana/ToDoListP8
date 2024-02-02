<?php

namespace App\Models;

class DatabaseModel
{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct($server, $database, $username, $password)
    {
        $this->server = $server;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect()
    {
        try {
            $this->connection = new \PDO("mysql:server={$this->server};database={$this->database}", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    
    public function get_connection(){
        return $this-> connection;
    }


}
