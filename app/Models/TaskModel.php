<?php

namespace App\Models;

use Database\PDO\DatabaseConnection;

class TaskModel
{
    private $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function getAllTasks()
    {
   
    }

    public function addTask($id, $title, $task, $complete)
    {
  
    }

    public function updateTask($id, $title, $task, $complete)
    {

    }

    public function deleteTask($id)
    {
      
    }
}
