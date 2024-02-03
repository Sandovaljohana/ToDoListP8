<?php

namespace App\Models;

use Database\PDO\DatabaseConnection;

class DeleteTaskModel {

    private $connection;

    public function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    public function deleteTaskById($id) {
        try {
            // Verificar si la tarea con el ID proporcionado existe antes de eliminar
            $task = $this->getTaskById($id);

            if (!$task) {
                // La tarea no existe, no se puede eliminar
                return false;
            }

            // La tarea existe, proceder con la eliminación
            $sql = "DELETE FROM tasks WHERE id=?";
            $statement = $this->connection->get_connection()->prepare($sql);
            $statement->execute([$id]);
            
            return true; // Indica que la eliminación fue exitosa
        } catch (\PDOException $e) {
            // Manejar el error según tus necesidades
            return false; // Indica que la eliminación falló
        }
    }

    private function getTaskById($id) {
        // Obtener la tarea por ID
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $statement = $this->connection->get_connection()->prepare($sql);
        $statement->execute([$id]);

        // Devolver la tarea o null si no se encuentra
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
