<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentRequirements extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllRequirements($ID){
        $query = "SELECT * FROM requirements WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function InsertEPortfolio($data) {
        $currentDate = date('Y-m-d'); 
        $query = "INSERT INTO requirements (StudentID, Title, FilePath, Date, Type) 
        VALUES($data[0], '$data[1]', '$data[2]', '$currentDate', 'Portfolio')";
        return $this->db->query($query);
    }

    public function InsertECBAR($data) {
        $currentDate = date('Y-m-d'); 
        $query = "INSERT INTO requirements (StudentID, Title, FilePath, Date, Type) 
        VALUES($data[0], '$data[1]', '$data[2]', '$currentDate', 'CBAR')";
        return $this->db->query($query);
    }


    public function InsertPortfolio($id, $lesson, $newName){
        $currentDate = date('Y-m-d'); 
        if ($newName) {
            $query = "INSERT INTO requirements (StudentID, Title, FilePath, Date, Type) 
                      VALUES($id, '$lesson', '$newName', '$currentDate', 'Portfolio')";
        } else {
            $query = "INSERT INTO requirements (StudentID, Lesson, FilePath, Date, Type) 
                      VALUES($id, '$lesson', NULL, '$currentDate', 'Portfolio')";
        }
        return $this->db->query($query);
    }

    public function InsertCBAR($id, $lesson, $newName){
        $currentDate = date('Y-m-d'); 
        if ($newName) {
            $query = "INSERT INTO requirements (StudentID, Title, FilePath, Date, Type) 
                      VALUES($id, '$lesson', '$newName', '$currentDate', 'CBAR')";
        } else {
            $query = "INSERT INTO requirements (StudentID, Lesson, FilePath, Date, Type) 
                      VALUES($id, '$lesson', NULL, '$currentDate', 'CBAR')";
        }
        return $this->db->query($query);
    }
}
