<?php
require_once '../vendor/autoload.php';
require_once '../app/Config/config.php';

use App\Controllers\ToDoListController;

$controller = new ToDoListController();

// Manejar las rutas
$uri = $_SERVER['REQUEST_URI'];
switch ($uri) {
    case '/add':
        $controller->add();
        break;
    case preg_match('/\/delete\/(\d+)/', $uri, $matches) ? true : false:
        $controller->delete($matches[1]);
        break;
    default:
        $controller->showAll();
        break;
}
