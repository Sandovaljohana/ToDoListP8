<?php
require_once __DIR__ . '../../app/config.php';
require_once __DIR__ . '../../app/Controllers/TodolistController.php';

use App\Controllers\TodolistController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $todolist = new TodolistController();

   
    $query = "INSERT INTO tasks (title, task, stage) VALUES ('{$_POST['title']}', '{$_POST['task']}', {$_POST['stage']})";
    $result = $todolist->store($_POST);
    
    echo json_encode($result);
    exit();
    
}

?>
