<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class TeacherRequirements extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'School', 'Program']; 

    public function PSTRequirements($ID){
        $query = "SELECT * FROM requirements WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function GetStudentName($ID){
        $query = "SELECT Name FROM Student WHERE ID = ?";
          
        $result = $this->db->query($query, [$ID]);

        if ($result->getNumRows() > 0) {
            return $result->getRow()->Name; 
        }

        return null; 
    }
}
