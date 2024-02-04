<?php
namespace App\Controllers;

require_once __DIR__ . '/../../database/PDO/DatabaseConnection.php';

use Database\PDO\DatabaseConnection;

class TodolistController
{
    private $connection;

    public function __construct()
    {
        $config = include(__DIR__ . '../../../Config/config.php');
        $databaseConfig = $config['database'] ?? [];

        $this->connection = new DatabaseConnection(
            $databaseConfig['server'],
            $databaseConfig['database'],
            $databaseConfig['username'],
            $databaseConfig['password']
        );

        $this->connection->connect();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getTasks()
    {
        $sql = "SELECT * FROM tasks";
        $statement = $this->connection->get_connection()->query($sql);
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $results;
    }
}
?>
