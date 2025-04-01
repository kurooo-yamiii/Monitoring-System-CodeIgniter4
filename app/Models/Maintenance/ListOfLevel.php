<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class ListOfLevel extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'grade'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'Grade',    
        'Level',
    ];

    public function GetListOfGrade(){
        $query = "SELECT * FROM grade";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function CheckExistingGrade($grade) {
        $query = "SELECT * FROM grade WHERE Grade = ?";
        $builder = $this->db->query($query, [$grade]);
        return $builder->getNumRows() > 0;
    }

    public function GenerateNewGrade($grade, $level) {
        $query = "INSERT INTO grade(Grade, Level) 
               VALUES('$grade', '$level')";
        return $this->db->query($query);
    }

    public function UpdateGradeLevel($ID, $grade, $level) {
        $query = "UPDATE grade SET Grade = '$grade', Level = '$level'
                    WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function DeleteGrade($ID) {
        $query = "DELETE FROM grade WHERE ID = $ID";
        return $this->db->query($query);
    }

}
