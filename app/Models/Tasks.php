<?php
require_once __DIR__ . '../../Models/AddTaskModel.php';
require_once __DIR__ . '../../Models/DeleteTaskModel.php';
require_once __DIR__ . '../../Controllers/TodolistController.php';
require_once __DIR__ . '../../Models/GetTasksModel.php';

use App\Controllers\TodolistController;
use App\Models\AddTaskModel;
use App\Models\DeleteTaskModel;
use App\Models\GetTasksModel;

$controller = new TodolistController();
$addTaskModel = new AddTaskModel($controller->getConnection());
$deleteTaskModel = new DeleteTaskModel($controller->getConnection());
$getTasksModel = new GetTasksModel($controller->getConnection());

$results = $getTasksModel->getTasks();  // Utilizamos el nuevo modelo para obtener las tareas

if (!isset($results) || !is_array($results)) {
    $results = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addTask'])) {
    $title = $_POST['title'];
    $task = $_POST['task'];
    $addTaskModel->addTask($title, $task);
    $results = $getTasksModel->getTasks();  // Actualizamos las tareas después de agregar una nueva
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
    $deleteTaskModel->deleteTaskById($taskId);
    $results = $getTasksModel->getTasks();  // Actualizamos las tareas después de eliminar una tarea
}
?>