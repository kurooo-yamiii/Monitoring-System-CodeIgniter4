<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class ToDoList extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllTodoList($ID) {
        $query = "SELECT * FROM todolist WHERE AccID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function UpdateStatusTodoList($ID, $TodoID) {
        $builder = $this->db->table('todolist');
    
        $builder->set('Checked', 1);
        $builder->where('AccID', $ID);
        $builder->where('ID', $TodoID);
        
        $result = $builder->update();
    
        if ($result) {
            return "Success";
        } else {
            return "Error";
        }
    }
}
