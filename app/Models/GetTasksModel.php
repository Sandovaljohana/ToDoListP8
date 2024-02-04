<?php
namespace App\Models;

use Database\PDO\DatabaseConnection;

class GetTasksModel
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
            $statement = $pdo->query($sql);
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $results;
        } catch (\PDOException $e) {
            echo "Error retrieving tasks: " . $e->getMessage();
            return [];
        }
    }
}
?>