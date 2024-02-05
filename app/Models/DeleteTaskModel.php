<?php

namespace App\Models;

use Database\PDO\DatabaseConnection;

class DeleteTaskModel {

    private $connection;

    public function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    public function deleteTaskById($id) {
        $sql = "DELETE FROM tasks WHERE id=?";
        $stmt = $this->connection->get_connection()->prepare($sql);
        $stmt->execute([$id]);
        return true;
    }
           
 
    private function getTaskById($id) {
      
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $this->pdo->get_connection()->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
?>