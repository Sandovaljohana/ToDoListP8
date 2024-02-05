<?php
namespace App\Models;

use Database\PDO\DatabaseConnection;

class ShowTaskModel
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getTasks()
    {
        try {
          
            $pdo = $this->connection->get_connection();

           
            $sql = "SELECT * FROM tasks";

            $stmt = $pdo->query($sql);

            if ($stmt) {
            
                $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                

                return $results;
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            echo "Error to get tasks: " . $e->getMessage();
            return [];
        }
    }

    public function getTaskById($taskId)
{
    try {
        $pdo = $this->connection->get_connection();
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$taskId]);
        
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    } catch (\PDOException $e) {
        echo "Error to get task by ID: " . $e->getMessage();
        return null;
    }
}

}