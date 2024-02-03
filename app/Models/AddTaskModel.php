<?php

namespace App\Models;

use Database\PDO\DatabaseConnection;
class AddTaskModel
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function addTask($title, $task)
    {
        try {
            $pdo = $this->connection->get_connection();
            $sql = "INSERT INTO tasks (title, task) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $task]);
            return $pdo->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al agregar tarea: " . $e->getMessage();
            return false;
        }
    }
}


