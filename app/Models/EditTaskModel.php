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
            $taskId = $_POST['id']; 
            $editedTask = $_POST['task'];

            $showTaskModel = new ShowTaskModel($this->connection);
            $existingTask = $showTaskModel->getTaskById($taskId);

            if ($existingTask) {
              
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

    private function editTaskById($id, $newTask)
    {
        try {
           
            $pdo = $this->connection->get_connection();

            $sql = "UPDATE tasks SET task = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$newTask, $id]);

            return true; 
        } catch (\PDOException $e) {
           
            return false; 
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

        return true; 
    } catch (\PDOException $e) {
        return false; 
}

}
}
?>
