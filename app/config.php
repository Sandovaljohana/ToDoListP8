<?php

$server = "localhost";
$database = "todolist";
$username = "johana";
$password = "johana";

try {
    $connection = new PDO("mysql:host=$server", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    $connection->exec($sql);

    echo "Base de datos '$database' creada con éxito.";

} catch (PDOException $e) {
    echo "Error al crear la base de datos: " . $e->getMessage();
}
?>
