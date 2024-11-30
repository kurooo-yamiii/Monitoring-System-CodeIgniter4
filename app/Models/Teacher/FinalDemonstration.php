<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class FinalDemonstration extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name', 'Profile'];

    public function FetchAllDemoRecord($ID) {
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

    public function FinalDemoPreview($ID) {
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
    
    public function FinalDemoCreation($data) {
        $info = $data['info'];
        $firstSet = $data['firstSet'];
        $secondSet = $data['secondSet'];
        $thirdSet = $data['thirdSet'];
        $fourthSet = $data['fourthSet'];
        $fifthSet = $data['fifthSet'];

        $at = $this->CalculateAverage($firstSet);
        $bt = $this->CalculateAverage($secondSet);
        $ct = $this->CalculateAverage($thirdSet);
        $dt = $this->CalculateAverage($fourthSet);
        $et = $this->CalculateAverage($fifthSet);
        $overall = ($at + $bt + $ct + $dt + $et) / 5;
        $average = sprintf("%.2f", $overall);

        $dbData = [
            'StudentID' => $info['studentid'],
            'ResourceID' => $info['teacherid'],
            'Name' => $info['pst'],
            'SubjectGrade' => $info['subject'],
            'Date' => $info['date'],
            'Quarter' => $info['quarter'],
            'Observer' => $info['observer'],
            'School' => $info['cooperating'],
            'Strenghts' => $info['strenght'],
            'Improvement' => $info['improvement'],

            '1A' => $firstSet['a1'], '1B' => $firstSet['a2'], '1C' => $firstSet['a3'],
            '1D' => $firstSet['a4'], '1E' => $firstSet['a5'], 

            '2A' => $secondSet['b1'], '2B' => $secondSet['b2'], '2C' => $secondSet['b3'],
            '2D' => $secondSet['b4'], '2E' => $secondSet['b5'], 

            '3A' => $thirdSet['c1'], '3B' => $thirdSet['c2'], '3C' => $thirdSet['c3'],
            '3D' => $thirdSet['c4'], '3E' => $thirdSet['c5'], 

            '4A' => $fourthSet['d1'], '4B' => $fourthSet['d2'], '4C' => $fourthSet['d3'],
            '4D' => $fourthSet['d4'], '4E' => $fourthSet['d5'], 

            '5A' => $fifthSet['e1'], '5B' => $fifthSet['e2'], '5C' => $fifthSet['e3'],
            '5D' => $fifthSet['e4'], '5E' => $fifthSet['e5'], 

            'Average' => $average
        ];

        if ($this->db->table('finaldemo')->insert($dbData)) {
            return $this->db->insertID();
        }
        return false;
    }

    public function FinalDemoUpdate($data) {
        $info = $data['info'];
        $firstSet = $data['firstSet'];
        $secondSet = $data['secondSet'];
        $thirdSet = $data['thirdSet'];
        $fourthSet = $data['fourthSet'];
        $fifthSet = $data['fifthSet'];

        $at = $this->CalculateAverage($firstSet);
        $bt = $this->CalculateAverage($secondSet);
        $ct = $this->CalculateAverage($thirdSet);
        $dt = $this->CalculateAverage($fourthSet);
        $et = $this->CalculateAverage($fifthSet);
        $overall = ($at + $bt + $ct + $dt + $et) / 5;
        $average = sprintf("%.2f", $overall);

        $dbData = [
            'Name' => $info['pst'],
            'SubjectGrade' => $info['subject'],
            'Date' => $info['date'],
            'Quarter' => $info['quarter'],
            'Observer' => $info['observer'],
            'School' => $info['cooperating'],
            'Strenghts' => $info['strenght'],
            'Improvement' => $info['improvement'],

            '1A' => $firstSet['a1'], '1B' => $firstSet['a2'], '1C' => $firstSet['a3'],
            '1D' => $firstSet['a4'], '1E' => $firstSet['a5'], 

            '2A' => $secondSet['b1'], '2B' => $secondSet['b2'], '2C' => $secondSet['b3'],
            '2D' => $secondSet['b4'], '2E' => $secondSet['b5'], 

            '3A' => $thirdSet['c1'], '3B' => $thirdSet['c2'], '3C' => $thirdSet['c3'],
            '3D' => $thirdSet['c4'], '3E' => $thirdSet['c5'], 

            '4A' => $fourthSet['d1'], '4B' => $fourthSet['d2'], '4C' => $fourthSet['d3'],
            '4D' => $fourthSet['d4'], '4E' => $fourthSet['d5'], 

            '5A' => $fifthSet['e1'], '5B' => $fifthSet['e2'], '5C' => $fifthSet['e3'],
            '5D' => $fifthSet['e4'], '5E' => $fifthSet['e5'], 

            'Average' => $average
        ];

        $id = $info['id']; 
    
        if ($this->db->table('finaldemo')->where('ID', $id)->update($dbData)) {
            return true; 
        }
        return false;
    }

    public function DeleteFinalDemo($ID) {
        $query = "DELETE FROM finaldemo WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function ComputeFinalAverage($ID) {
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

    private function CalculateAverage($set) {
        $total = array_sum($set);
        return $total / 5; 
    }

    public function GetStudentLessonPlan($id) {
        $query = "SELECT * FROM lessonplan WHERE Final = 1 AND StudentID = ?";
        $builder = $this->db->query($query, [$id]);
        return $builder->getResultArray();
    }
}
