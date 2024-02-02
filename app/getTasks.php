<?php
function obtenerTareasDesdeBD() {
  
    return [
        ["title" => "Tarea 1", "task" => "Descripción tarea 1", "stage" => 1],
        ["title" => "Tarea 2", "task" => "Descripción tarea 2", "stage" => 2],
        
    ];
}

function formatearComoHTML($tasks) {
  
    $html = "<ul>";
    foreach ($tasks as $task) {
        $html .= "<li>{$task['title']} - {$task['task']} - Estado: {$task['stage']}</li>";
    }
    $html .= "</ul>";
    return $html;
}
?>
