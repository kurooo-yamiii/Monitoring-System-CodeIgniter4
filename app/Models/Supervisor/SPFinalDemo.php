<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class SPFinalDemo extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function FetchSTScoresAndInfo(){
        $query = "SELECT 
            ST.*, 
            COALESCE(TM.Grade, 'N/A') AS TotalGrade,
            FORMAT(FD.AvgAverage, 2) AS ComputedAverage
        FROM student ST
        LEFT JOIN (
            SELECT 
                StudentID, 
                AVG(Average) AS AvgAverage
            FROM finaldemo
            GROUP BY StudentID
        ) FD ON FD.StudentID = ST.ID
        LEFT JOIN transmutation TM ON FD.AvgAverage BETWEEN TM.score_start AND TM.score_end;    
        ";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FindSearchData($search) {
        $query = "SELECT * FROM student WHERE Resource != '' AND (Name LIKE '%$search%' OR Program LIKE '%$search%' OR School LIKE '%$search%' OR Section LIKE '%$search%')";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FindByMajor($major) {
        if($major == 'FetchAll'){
            $query = "SELECT * FROM student WHERE Resource IS NOT NULL";
        }else{
            $query = "SELECT * FROM student WHERE Resource IS NOT NULL AND (Program LIKE '%$major%')";
        }
        $builder = $this->db->query($query);
        return $builder->getResult();
    }
	
    public function AllStudentFinalDemo($ID) {
        $query = "SELECT 
                fd.*,  
                tm.Grade  
            FROM 
                finaldemo fd
            LEFT JOIN 
                transmutation tm 
            ON 
                fd.Average BETWEEN tm.score_start AND tm.score_end
            WHERE 
                fd.StudentID = ?
            ORDER BY 
                fd.ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function GetOverallAverage($ID) {
        $query = "WITH AverageCalculation AS (
                    SELECT AVG(average) AS OverallAverage
                    FROM finaldemo
                    WHERE StudentID = ?
                  )
                  SELECT t.grade
                  FROM AverageCalculation ac
                  JOIN transmutation t
                  ON ac.OverallAverage BETWEEN t.score_start AND t.score_end;";
                  
        $result = $this->db->query($query, [$ID]);
    
        if ($result->getNumRows() > 0) {
            return $result->getRow()->grade; 
        }
    
        return null; 
    }

    public function ViewDemonstrationEvaluation($ID) {
        $query = "SELECT 
            'Content Knowledge and Pedagogy' AS Variable, 
            1A AS Q1, 
            1B AS Q2, 
            1C AS Q3, 
            1D AS Q4, 
            1E AS Q5, 
            ROUND((1A + 1B + 1C + 1D + 1E) / 5, 2) AS Total
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Learning Environment' AS Variable, 
            2A AS Q1, 
            2B AS Q2, 
            2C AS Q3, 
            2D AS Q4, 
            2E AS Q5, 
            ROUND((2A + 2B + 2C + 2D + 2E) / 5, 2) AS Total
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Diversity of Learners' AS Variable, 
            3A AS Q1, 
            3B AS Q2, 
            3C AS Q3, 
            3D AS Q4, 
            3E AS Q5, 
            ROUND((3A + 3B + 3C + 3D + 3E) / 5, 2) AS Total
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Curriculum and Planning' AS Variable, 
            4A AS Q1, 
            4B AS Q2, 
            4C AS Q3, 
            4D AS Q4, 
            4E AS Q5, 
            ROUND((4A + 4B + 4C + 4D + 4E) / 5, 2) AS Total
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Assessment and Reporting' AS Variable, 
            5A AS Q1, 
            5B AS Q2, 
            5C AS Q3, 
            5D AS Q4, 
            5E AS Q5, 
            ROUND((5A + 5B + 5C + 5D + 5E) / 5, 2) AS Total
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Average' AS Variable, 
            NULL AS Q1, 
            NULL AS Q2, 
            NULL AS Q3, 
            NULL AS Q4, 
            NULL AS Q5, 
            Average AS Total 
        FROM 
            finaldemo 
        WHERE 
            ID = ? 
        
        UNION ALL 
        
        SELECT 
            'Transmute' AS Variable, 
            NULL AS Q1, 
            NULL AS Q2, 
            NULL AS Q3, 
            NULL AS Q4, 
            NULL AS Q5, 
            tm.Grade AS Total 
        FROM 
            finaldemo fd
        LEFT JOIN 
            transmutation tm 
        ON 
            fd.Average BETWEEN tm.score_start AND tm.score_end
        WHERE 
            fd.ID = ?
        ";
        $builder = $this->db->query($query, [$ID, $ID, $ID, $ID, $ID, $ID, $ID]);
        return $builder->getResultArray();
    }

}
