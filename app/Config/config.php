<?php

require_once __DIR__ . '../../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) . '/Views');


$twig = new \Twig\Environment($loader);
?>