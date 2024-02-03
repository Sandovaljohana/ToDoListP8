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
            // Obtener la conexión a la base de datos
            $pdo = $this->connection->get_connection();

            // Preparar la consulta SQL
            $sql = "SELECT * FROM tasks";

            // Ejecutar la consulta y obtener el resultado
            $stmt = $pdo->query($sql);

            // Comprobar si hay resultados antes de devolverlos
            if ($stmt) {
                // Obtener todos los resultados
                $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                
                // Imprimir los resultados si es necesario
               //  foreach ($results as $result) {
                //     print_r($result);
                 //}

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