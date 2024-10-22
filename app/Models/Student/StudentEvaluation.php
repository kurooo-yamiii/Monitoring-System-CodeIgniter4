<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentEvaluation extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllEvaluation($ID){
        $query = "SELECT * FROM evaluation WHERE ID = ?";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }
}
