<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class SupervisorLP extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program'];
    
    public function FetchAllLessonLP(){
        $query = "SELECT 
            S.Name, 
            S.ID,
            COALESCE(RT.Name, 'Not Deployed Yet') AS ResourceTeacher,
            COALESCE(RT.School, 'Not Deployed Yet') AS DeployedSchool,
            CONCAT(S.Program, '-', S.Section) AS BlockSection,
            CASE 
                WHEN COUNT(LP.StudentID) = 0 THEN 'No Lesson Plan Created Yet by the Pre-Service Teacher'
                ELSE CONCAT('A Total of ', COUNT(LP.StudentID), ' Lesson Plan(s) have Been Created by the Pre-Service Teacher')
            END AS TotalLesson,
            CASE 
                WHEN AVG(CASE WHEN LP.Grade > 0 THEN LP.Grade ELSE NULL END) IS NULL THEN 'No Grades Available'
                ELSE CONCAT(ROUND(AVG(CASE WHEN LP.Grade > 0 THEN LP.Grade ELSE NULL END), 2))
            END AS OverallAverage
        FROM 
            student S
        LEFT JOIN 
            lessonplan LP 
        ON 
            LP.StudentID = S.ID
        LEFT JOIN 
            teacher RT
        ON
            RT.Student = S.ID
        GROUP BY 
            S.ID"
        ;
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function SelectedStudentLP($ID){
        $query = "SELECT * FROM lessonplan WHERE StudentID = ? AND Final = 0 ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function LPFinalEvaluation($ID) {
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
