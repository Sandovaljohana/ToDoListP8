<?php

namespace App\Controllers;

use Database\PDO\DatabaseConnection;
use App\Models\ShowTaskModel;
use App\Models\AddTaskModel;


class ToDoListController
{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;
    private $showTaskModel;
    private $addTaskModel;

    public function __construct()
    {
        $this->server = "localhost";
        $this->database = "todolist";
        $this->username = "johana";
        $this->password = "johana";

        $this->connection = new DatabaseConnection(
            $this->server,
            $this->database,
            $this->username,
            $this->password
        );

        $this->connection->connect();

        $this->showTaskModel = new ShowTaskModel($this->connection);
        $this->addTaskModel = new AddTaskModel($this->connection);
    }

    public function getTasks()
    {
        // Obtener todas las tareas
        $tasks = $this->showTaskModel->getTasks();

        return $tasks;
    }

    // ToDoListController.php

public function addTask()
{
    // Verificar si se ha enviado el formulario para agregar tarea
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addTask'])) {
        // Obtener los datos del formulario
        $title = $_POST['title'];
        $task = $_POST['task'];

        // Llamar al método addTask del modelo correspondiente
        $this->addTaskModel->addTask($title, $task);
    }

    // Recuperar las tareas y actualizar la vista
    $tasks = $this->showTaskModel->getTasks();
    // Puedes pasar las tareas a la vista o realizar otras operaciones
 
}

}
