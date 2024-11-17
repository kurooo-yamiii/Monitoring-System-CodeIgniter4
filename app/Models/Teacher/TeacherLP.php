<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class TeacherLP extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Grade', 'Program']; 

    public function FetchStudentName($ID){
        $query = "SELECT Name FROM Student WHERE ID = ?";
          
        $result = $this->db->query($query, [$ID]);

        if ($result->getNumRows() > 0) {
            return $result->getRow()->Name; 
        }

        return null; 
    }

    public function GetAllPSTLP($ID){
        $query = "SELECT * FROM lessonplan WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function UpdateLPRemarks($ID, $Grade, $Remarks) {
        $query = "UPDATE lessonplan SET Grade = ?, Remarks = ? WHERE ID = ?";
          
        $result = $this->db->query($query, [$Grade, $Remarks, $ID]);

        if ($result) {
            return  true;
        }

        return null; 
    }

    public function LessonPlanFinalGrade($ID) {
        $query = "SELECT AVG(Grade) AS OverallAverage
                    FROM lessonplan
                    WHERE StudentID = ? AND Grade > 0";
                  
        $result = $this->db->query($query, [$ID]);
    
        if ($result->getNumRows() > 0) {
            return $result->getRow()->OverallAverage; 
        }
    
        return null; 
    }

}
