<?php
// Tasks.php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\TodolistController;
use App\Models\GetTasksModel;
use App\Models\ShowTaskModel;

$controller = new TodolistController();
$getTasksModel = new GetTasksModel($controller->getConnection());
$showTaskModel = new ShowTaskModel($controller->getConnection());

// Obtener todas las tareas
$tasks = $getTasksModel->getTasks();

// Mostrar las tareas
foreach ($tasks as $task) {
    echo $task['title'] . ": " . $task['task'] . "\n";
}

// Obtener una tarea específica por ID
$task = $showTaskModel->getTaskById(1);
echo $task['title'] . ": " . $task['task'] . "\n";