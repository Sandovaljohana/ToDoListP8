<?php

namespace App\Controllers;

use Database\PDO\DatabaseConnection;
use App\Models\ShowTaskModel;
use App\Models\AddTaskModel;
use App\Models\DeleteTaskModel;

class ToDoListController
{
    private $connection;
    private $showTaskModel;
    private $addTaskModel;
    private $deleteTaskModel;

    public function __construct()
    {
        $config = include(__DIR__ . '../../../Config/config.php');
        $databaseConfig = $config['database'] ?? [];

        $this->connection = new DatabaseConnection($databaseConfig);
        $this->connection->connect();

        $this->showTaskModel = new ShowTaskModel($this->connection);
        $this->addTaskModel = new AddTaskModel($this->connection);
        $this->deleteTaskModel = new DeleteTaskModel($this->connection);
    }

    public function getTasks()
    {
        // Obtener todas las tareas
        $tasks = $this->showTaskModel->getTasks();

        return $tasks;
    }


    public function addTask()
    {
        // Verificar si se ha enviado el formulario para agregar tarea
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addTask'])) {
            // Obtener los datos del formulario
            $title = $_POST['title'];
            $task = $_POST['task'];
    
            // Llamar al método addTask del modelo correspondiente
            $this->addTaskModel->addTask($title, $task);
    
            // Redireccionar a la misma página para evitar el reenvío del formulario
            header("Location: index.php");
            exit();
        }
    
        // Recuperar las tareas y actualizar la vista
        $tasks = $this->showTaskModel->getTasks();
        // Puedes pasar las tareas a la vista o realizar otras operaciones
    }

    public function deleteTask() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $success = $this->deleteTaskModel->deleteTaskById($id);

            // Realizar otras acciones según el éxito o fracaso de la eliminación
            if ($success) {
                // Éxito: recargar la página o redirigir según tu lógica
                header("Location: index.php");
                exit();
            } else {
                // Fracaso: manejar el error
                echo "Error al intentar eliminar la tarea.";
            }
        }
    }

    
}