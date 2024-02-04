<?php

namespace Database\PDO;

class DatabaseConnection
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
            $this->connection = new \PDO("mysql:host=$this->server;dbname=$this->database",
                $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $setNames = $this->connection->prepare("SET NAMES 'utf8'");
            $setNames->execute();
        } catch (\PDOException $e) {
            throw new \PDOException("Error connecting to the database: " . $e->getMessage());
        }
    }

    public function get_connection()
    {
        return $this->connection;
    }
}
?>
