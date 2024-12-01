<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class SPRequirements extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function FetchAllRequirementsGrade(){
        $query = "SELECT 
                S.Name, 
                S.ID,
                COALESCE(RT.Name, 'Not Deployed Yet') AS ResourceTeacher,
                COALESCE(RT.School, 'Not Deployed Yet') AS DeployedSchool,
                CONCAT(S.Program, '-', S.Section) AS BlockSection,
                COALESCE(
                    MAX(
                        CASE 
                            WHEN RQ.Type = 'CBAR' AND RQ.Grade = 0 THEN 'Not Graded Yet'
                            WHEN RQ.Type = 'CBAR' THEN FORMAT(RQ.Grade, 2)
                        END
                    ),
                    'No Requirements Attached'
                ) AS CBAR,
                COALESCE(
                    MAX(
                        CASE 
                            WHEN RQ.Type = 'Portfolio' AND RQ.Grade = 0 THEN 'Not Graded Yet'
                            WHEN RQ.Type = 'Portfolio' THEN FORMAT(RQ.Grade, 2)
                        END
                    ),
                    'No Requirements Attached'
                ) AS Portfolio
            FROM 
                student S
            LEFT JOIN 
                requirements RQ 
            ON 
                RQ.StudentID = S.ID
            LEFT JOIN 
                teacher RT
            ON
                RT.Student = S.ID
            GROUP BY 
                S.ID, S.Name, S.Program, S.Section, RT.Name, RT.School";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function RequirementsOfPST($ID){
        $query = "SELECT * FROM requirements WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function UpdateStudentGrade($ID, $Grade) {
        $query = "UPDATE requirements SET Grade = ? WHERE ID = ?";
        $builder = $this->db->query($query, [$Grade, $ID]);
        return $this->db->affectedRows() > 0;
    }

}
