<?php

namespace App\Models;

use Database\PDO\DatabaseConnection;

class EditTaskModel
{
    private $connection;

    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

   
        public function editTask()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
                $taskId = $_POST['id']; // Obtén el ID de $_POST, no de $_GET
                $editedTask = $_POST['task'];

            $showTaskModel = new ShowTaskModel($this->connection);
            $existingTask = $showTaskModel->getTaskById($taskId);

            if ($existingTask) {
                // Utiliza el propio modelo para editar la tarea
                $success = $this->editTaskById($taskId, $editedTask);

                if ($success) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error al intentar editar la tarea.";
                }
            } else {
                echo "La tarea no existe.";
            }
        }
    }

    public function getTaskById($id)
    {
        $pdo = $this->connection->get_connection();
        $sql = "SELECT * FROM tasks WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Devolver la tarea o null si no se encuentra
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function editTaskById($id, $newTask)
    {
        try {
            // Obtén la conexión a la base de datos
            $pdo = $this->connection->get_connection();
    
            // Prepara la consulta SQL
            $sql = "UPDATE tasks SET task = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
    
            // Ejecuta la consulta con los nuevos datos de la tarea
            $stmt->execute([$newTask, $id]);
    
            return true; // La actualización fue exitosa
        } catch (\PDOException $e) {
            // Maneja el error según tus necesidades
            return false; // La actualización falló
        }
    }
}