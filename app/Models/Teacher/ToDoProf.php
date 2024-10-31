<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class ToDoProf extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'todolist';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Title', 'Date', 'AccID', 'Checked'];

    public function GetAllTodoList($ID) {
        $query = "SELECT * FROM todolist WHERE AccID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function CreateNewToDo($ID, $Lesson, $Date) {
        $query = "INSERT INTO todolist (Title, Date, AccID, Checked) 
        VALUES (?, ?, ?, ?)";
        return $this->db->query($query, [$Lesson, $Date, $ID, 0]);
    }

}
