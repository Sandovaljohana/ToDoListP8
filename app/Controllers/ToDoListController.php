<?php

namespace App\Controllers;

use Database\PDO\DatabaseConnection;
use App\Models\ShowTaskModel;
use App\Models\AddTaskModel;
use App\Models\DeleteTaskModel;
use App\Models\EditTaskModel;

class ToDoListController
{
    private $connection;
    private $showTaskModel;
    private $addTaskModel;
    private $deleteTaskModel;
    private $editTaskModel;

    public function __construct()
    {
        $config = include(__DIR__ . '../../../Config/config.php');
        $databaseConfig = $config['database'] ?? [];

        $this->connection = new DatabaseConnection($databaseConfig);
        $this->connection->connect();

        $this->showTaskModel = new ShowTaskModel($this->connection);
        $this->addTaskModel = new AddTaskModel($this->connection);
        $this->deleteTaskModel = new DeleteTaskModel($this->connection);
        $this->editTaskModel = new EditTaskModel($this->connection);
    }

    public function get_connection()
    {
        return $this->connection;
    }

    public function getTasks()
    {
       
        $tasks = $this->showTaskModel->getTasks();

        return $tasks;
    }


    public function addTask()
    {
       
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addTask'])) {
           
            $title = $_POST['title'];
            $task = $_POST['task'];
    
          
            $this->addTaskModel->addTask($title, $task);
    
         
            header("Location: index.php");
            exit();
        }
    
        
        $tasks = $this->showTaskModel->getTasks();
       
    }

    public function deleteTask()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteTask'])) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $success = $this->deleteTaskModel->deleteTaskById($id);
    
              
                if ($success) {
                 
                    header("Location: index.php");
                    exit();
                } else {
                   
                    echo "Error al intentar eliminar la tarea.";
                }
            }
        }
    }   
    
    public function updateTaskStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateTaskStatus'])) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $complete = (isset($_POST['complete'])) ? 1 : 0;
               
                $this->editTaskModel->updateTaskStatus($id, $complete);
    
                header("Location: index.php");
                exit();
            }
        }
    }
    
}

?>
