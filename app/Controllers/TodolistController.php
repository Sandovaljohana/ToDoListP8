<?php

namespace App\Controllers;

use App\Models\DatabaseModel;

require __DIR__ . '/../../vendor/autoload.php';

use Exception;

class TodolistController
{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->server = "localhost";
        $this->database = "todolist";
        $this->username = "johana";
        $this->password = "johana";

        $this->connection = new DatabaseModel($this->server, $this->database, $this->username, $this->password);

        $this->connection->connect();
    }

    public function createTable()
    {
        $query = "
        CREATE TABLE IF NOT EXISTS `tasks` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(100) NOT NULL,
            `task` varchar(100) NOT NULL,
            `stage` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

        try {

            $this->connection->get_connection()->exec("USE {$this->database}");

            $this->connection->get_connection()->exec($query);
        } catch (\PDOException $e) {
            throw new \PDOException("Error creating the 'tasks' table: " . $e->getMessage());
        }
    }

    public function executeQuery($query)
    {
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute();
            return $statement;
        } catch (\PDOException $e) {
            echo "Error de PDO: " . $e->getMessage();
            return null;
        }
    }

    public function store($data)
    {
        $query = "INSERT INTO tasks (title, task, stage) VALUES (?, ?, ?)";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $results = $statement->execute([$data['title'], $data['task'], $data['stage']]);
            if (!empty($results)) {
                $response = "La tarea '{$data['title']}' se ha registrado con éxito: '{$data['task']}' en estado '{$data['stage']}'";
                // Retornar la respuesta para que se pueda manejar en JavaScript
                return [$results, $response];
            }
        } catch (\PDOException $e) {
            // Lanza la excepción para que se pueda manejar en JavaScript
            throw new \PDOException("Error de PDO: " . $e->getMessage());
        }
    }

    public function show($id)
    {
        $query = "SELECT * FROM tasks WHERE id = ?";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute([$id]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo "An error occurred while displaying the task, please try again.";
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM tasks WHERE id = ?";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $results = $statement->execute([$id]);
            if (!empty($results)) {
                $response = "Task with ID  {$id} has been deleted successfully";
                var_dump($response);
                return [$results, $response];
            }
        } catch (Exception $e) {
            echo "An error occurred while deleting the task, please try again.";
        }
    }
}
