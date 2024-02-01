<?php

require "vendor/autoload.php";

try {
    $todolistController = new \App\Controllers\TodolistController();
    $todolistController->createTable();
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>