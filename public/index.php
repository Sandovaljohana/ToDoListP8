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
        <h1 class="flex justify-center p-8 font-bold font-sans text-red-500 text-4xl">Mi Lista de Tareas</h1>
    </header>


    <main class="flex flex-row justify-center">

        <div class="flex flex-col w-96 bg-red-100 rounded-lg h-52">
            <div>
                <h2 class="p-4 font-bold font-sans text-red-500 text-xl">Tareas:</h2>
                <div>
                <form action="tu_ruta_destino" method="POST" class="flex flex-col items-center justify-between h-full">
                    <input class="mb-4 p-2 bg-red-200 rounded-sm w-11/12" type="text" placeholder="Inserta la tarea aquí">
                    <button class="text-red-300 p-2 bg-red-800 rounded-lg text-white self-end mr-4">Agregar</button>
                </form>
                </div>
            </div>

        </div>



    </main>

    <footer>

    </footer>

</body>

</html>