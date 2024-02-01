<?php
require "vendor/autoload.php";

try {
    $todoListController = new \App\Controllers\ToDoListController();
    $todoListController->createTable();
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
