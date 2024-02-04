<?php

require_once __DIR__ . '../../../vendor/autoload.php';

use App\Controllers\TodolistController;
use App\Models\GetTasksModel;
use App\Models\ShowTaskModel;

$controller = new TodolistController();
$getTasksModel = new GetTasksModel($controller->getConnection());
$showTaskModel = new ShowTaskModel($controller->getConnection());


$tasks = $getTasksModel->getTasks();


foreach ($tasks as $task) {
    echo $task['title'] . ": " . $task['task'] . "\n";
}

$task = $showTaskModel->getTaskById(1);
echo $task['title'] . ": " . $task['task'] . "\n";