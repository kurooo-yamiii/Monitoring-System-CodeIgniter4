<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentLP extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function CreateLessonPlan($id, $lesson, $newName){
        $currentDate = date('Y-m-d'); 
        if ($newName) {
            $query = "INSERT INTO lessonplan (StudentID, Lesson, FilePath, Date) 
                      VALUES($id, '$lesson', '$newName', '$currentDate')";
        } else {
            $query = "INSERT INTO lessonplan (StudentID, Lesson, FilePath, Date) 
                      VALUES($id, '$lesson', NULL, '$currentDate')";
        }
        return $this->db->query($query);
    }

    public function UpdateLessonPlan($id, $lesson, $newName) {
        if ($newName) {
            $query = "UPDATE lessonplan SET Lesson = '$lesson', FilePath = '$newName' WHERE ID = $id";
        } else {
            $query = "UPDATE lessonplan SET Lesson = '$lesson' WHERE ID = $id";
        }
        return $this->db->query($query);
    }

    public function DeleteLP($ID){
        $query = "DELETE FROM lessonplan WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function GetAllLessonPlan($ID){
        $query = "SELECT * FROM lessonplan WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
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
