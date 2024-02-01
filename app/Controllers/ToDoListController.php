<?php
namespace App\Controllers;
use Database\PDO\DatabaseConnection;
use Exception;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Config/config.php';

class ToDoListController{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;
    private $twig;

    public function __construct()
    {
        global $twig;

        $this -> twig = $twig;
        $this -> server = "localhost";
        $this -> database = "todolist";
        $this -> username = "johana";
        $this -> password = "johana";

       $this -> connection = new DatabaseConnection($this->server, $this->database,  
                                                    $this->username,  $this->password);

       $this -> connection -> connect();
    }
    public function getTwig()
{
    return $this->twig;
}


    public function someMethod()
    {
        $twig = $this-> getTwig();
    }

    public function index()
    {
        // Obtener tareas (puedes cargar esto desde tu modelo si es necesario)
        $tasks = [
            ['id' => 1, 'task' => 'Completar tarea 1'],
            ['id' => 2, 'task' => 'Revisar tarea 2'],
            // ... más tareas ...
        ];

        // Renderizar la plantilla Twig
        echo $this->twig->render('index.twig', ['tasks' => $tasks]);
    }

    public function add()
    {
        // Lógica para agregar nueva tarea
        // ...

        // Redirigir a la página principal después de agregar
        header("Location: /");
        exit;
    }

     public function create(){
        $query = "CREATE TABLE `tasks` (
            `id` int(11) NOT NULL,
            `task` varchar(100) NOT NULL,
            `stage` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
          ALTER TABLE `tasks`
            ADD PRIMARY KEY (`id`);
          
          ALTER TABLE `tasks`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
          COMMIT;";

          try {
            $this->connection->get_connection()->exec($query);
            echo "Tasks' table successfully created.";
          } catch (Exception $e) {
            echo "Error creating the 'tasks' table : " . $e->getMessage();
          }

        }


   public function store($data){
    $query = "INSERT INTO tasks (task, stage) VALUES (?, ?)";
    try{
        $statement = $this->connection->get_connection()->prepare($query);
        $results = $statement->execute([$data['task'], $data['stage']]);
        if(!empty($results)){
            $response = "The task has been successfully registered '{$data['task']}' in the database";
            var_dump($response);
            return [$results, $response];
        }
    }catch(Exception $e){
        echo "An error occurred in the registration, please try again.";
    }
   }

    public function show($id){
        $query = "SELECT * FROM tasks WHERE id = ?";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $statement->execute([$id]);
            $result = $statement->fetch(\PDO::FETCH_ASSOC);
            echo $this->twig->render('todolist.twig', ['task' => $result]);
        } catch (Exception $e) {
            echo "An error occurred while displaying the task, please try again.";
        }
    }

    public function showAll()
    {
        // Obtener todas las tareas (puedes cargar esto desde tu modelo si es necesario)
        $tasks = [
            ['id' => 1, 'task' => 'Completar tarea 1'],
            ['id' => 2, 'task' => 'Revisar tarea 2'],
            // ... más tareas ...
        ];
    
        // Renderizar la plantilla Twig
        echo $this->twig->render('index.twig', ['tasks' => $tasks]);
    }
    

    public function delete($id)
    {
        // Lógica para borrar tarea por ID
        $query = "DELETE FROM tasks WHERE id = ?";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $results = $statement->execute([$id]);
            if (!empty($results)) {
                $response = "Task with ID {$id} has been deleted successfully";
                // Puedes agregar mensajes flash u otras lógicas aquí
            }
        } catch (Exception $e) {
            $response = "An error occurred while deleting the task, please try again.";
        }
    
        // Redirigir a la página principal después de borrar
        header("Location: /");
        exit;
    }
    
}


?>