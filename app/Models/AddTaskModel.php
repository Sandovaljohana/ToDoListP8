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
            
            if ($stmt->rowCount() > 0) {
                return $pdo->lastInsertId();
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "Error adding task: " . $e->getMessage();
            return false;
        }
    }
}
