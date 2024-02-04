<?php

require __DIR__ . '../../vendor/autoload.php';

use App\Controllers\ToDoListController;

$toDoListController = new ToDoListController();
$results = $toDoListController->getTasks();
$toDoListController->addTask();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/83c6a3b014.js" crossorigin="anonymous"></script>
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
                    <form id="taskForm" action="index.php" method="POST" class="flex flex-col items-center justify-between h-full">


                        <input id="title" class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" type="text" name="title" placeholder="title">

                        <input class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" type="text" id="task" name="task" placeholder="Insert task" aria-describedby="helpId">

                        <input class="cursor-pointer text-red-300 p-2 bg-red-800 rounded-lg text-white self-end mr-4" name="addTask" id="addTask" type="submit" value="addTask">


                    </form>
                </div>

                <div class="m-10">
                    <ul>
                        <?php
                        foreach ($results as $result) { ?>
                            <li>
                                <input type="checkbox" id="task" name="task" class="mr-2">

                                <label for="task" class="text-gray-800"><?php echo $result['task']; ?></label>

                                <button class="ml-4" onclick="editTask(<?php echo $result['id']; ?>)">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>

                                <button class="ml-4">
                                    <a href="?id=<?php echo $result['id']; ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </button>

                            </li>
                        <?php } ?>
                    </ul>


                </div>

            </div>



    </main>

    <footer>

    </footer>


</body>

</html>