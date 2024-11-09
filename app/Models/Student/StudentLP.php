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
}
