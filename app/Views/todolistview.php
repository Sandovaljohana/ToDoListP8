<?php

require_once __DIR__ . '../../config.php';
require_once __DIR__ . '../../Controllers/TodolistController.php';

use App\Controllers\TodolistController;

$todolist = new TodolistController();
$todolist->createTable();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>ToDoList</title>
</head>

<body>
    <header>
        <h1 class="flex justify-center p-8 font-bold font-sans text-red-500 text-4xl">To Do List</h1>
    </header>


    <main class="flex flex-row justify-center">

        <div class="flex flex-col w-96 bg-red-100 rounded-lg h-auto py-8">
            <div>
                <h2 class="p-4 font-bold font-sans text-red-500 text-xl">Tasks:</h2>
                <div>
                    <form id="taskForm" method="POST" class="flex flex-col items-center justify-between h-full">


                        <input id="title" class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" type="text" name="title" placeholder="Title">

                        <input id="task" class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" type="text" name="task" placeholder="Insert task">
                        <select id="stage" class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" name="stage">
                            <option id="1stage" value="1">High</option>
                            <option id="1stage" value="2">Medium</option>
                            <option id="1stage" value="3">Low</option>
                        </select>

                        <button class="text-red-300 p-2 bg-red-800 rounded-lg text-white self-end mr-4" type="button" onclick="addTask()">Add</button>
                    </form>

                    <div id="taskList">

                    </div>
                </div>

            </div>



    </main>

    <footer>

    </footer>


</body>

</html>