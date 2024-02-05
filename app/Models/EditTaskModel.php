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

            // Obtén la tarea existente para verificar si existe
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

    // Este método recibe un ID y una nueva tarea para editar en la base de datos
    private function editTaskById($id, $newTask)
    {
        try {
            // Obtén la conexión a la base de datos
            $pdo = $this->connection->get_connection();

            // Prepara la consulta SQL para actualizar la tarea
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

    public function updateTaskStatus($id, $complete)
{
    try {
        $pdo = $this->connection->get_connection();
        $id=$_POST['id'];
        $complete=(isset($_POST['complete']))?1:0;
        $sql = "UPDATE tasks SET complete=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$complete, $id]);

        return true; // Éxito
    } catch (\PDOException $e) {
        return false; // Fracaso
    }
}

}

?>
