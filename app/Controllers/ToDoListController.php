<?php
namespace App\Controllers;
use Database\PDO\DatabaseConnection;
use Exception;

require "vendor/autoload.php";

class ToDoListController{
    private $server;
    private $database;
    private $username;
    private $password;
    private $connection;

    public function __construct()
    {
        $this -> server = "localhost";
        $this -> database = "todolist";
        $this -> username = "johana";
        $this -> password = "johana";

       $this -> connection = new DatabaseConnection($this->server, $this->database,  
                                                    $this->username,  $this->password);

       $this -> connection -> connect();
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
            var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo "An error occurred while displaying the task, please try again.";
        }
    }
    public function delete($id){
        $query = "DELETE FROM tasks WHERE id = ?";
        try {
            $statement = $this->connection->get_connection()->prepare($query);
            $results = $statement->execute([$id]);
            if(!empty($results)){
                $response = "Task with ID  {$id} has been deleted successfully";
                var_dump($response);
                return [$results, $response];
            }
        } catch (Exception $e) {
            echo "An error occurred while deleting the task, please try again.";
        }
    }
}


?>