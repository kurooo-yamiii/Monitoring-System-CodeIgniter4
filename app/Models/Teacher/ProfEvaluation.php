<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class ProfEvaluation extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name', 'Profile'];

    public function GetAllEvaluation($ID){
        $query = "SELECT * FROM evaluation WHERE StudentID = ? ORDER BY ID DESC";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function OrganizeTableEvaluation($ID) {
        $query = "
        SELECT 'Lesson Proper' AS Variable, a1 AS Q1, a2 AS Q2, a3 AS Q3, a4 AS Q4, a5 AS Q5, aT AS Total FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Mastery of the Lesson', b1, b2, b3, b4, b5, bT FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Lesson Plan', c1, c2, c3, c4, c5, cT FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Conduct of Assessment', d1, d2, d3, d4, d5, dT FROM evaluation WHERE ID = ? 
        UNION ALL 
        SELECT 'Average', NULL, NULL, NULL, NULL, NULL, (SELECT Average FROM evaluation WHERE ID = ?); ";
        $builder = $this->db->query($query, [$ID, $ID, $ID, $ID, $ID]);
        return $builder->getResultArray();
    }

    public function GetEvaluationRemarks($ID) {
        $query = "SELECT Remarks FROM evaluation WHERE ID = ?";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function EvaluationCreation($data) {
        $info = $data['info'];
        $firstSet = $data['firstSet'];
        $secondSet = $data['secondSet'];
        $thirdSet = $data['thirdSet'];
        $fourthSet = $data['fourthSet'];

        $at = $this->CalculateAverage($firstSet);
        $bt = $this->CalculateAverage($secondSet);
        $ct = $this->CalculateAverage($thirdSet);
        $dt = $this->CalculateAverage($fourthSet);
        $average = ($at + $bt + $ct + $dt) / 4 . '%';

        $dbData = [
            'StudentID' => $info['id'],
            'Date' => $info['date'],
            'Lesson' => $info['lesson'],
            'Remarks' => $info['remarks'],

            'a1' => $firstSet['a1'], 'a2' => $firstSet['a2'], 'a3' => $firstSet['a3'],
            'a4' => $firstSet['a4'], 'a5' => $firstSet['a5'], 'aT' => $at,

            'b1' => $secondSet['b1'], 'b2' => $secondSet['b2'], 'b3' => $secondSet['b3'],
            'b4' => $secondSet['b4'], 'b5' => $secondSet['b5'], 'bT' => $bt,

            'c1' => $thirdSet['c1'], 'c2' => $thirdSet['c2'], 'c3' => $thirdSet['c3'],
            'c4' => $thirdSet['c4'], 'c5' => $thirdSet['c5'], 'cT' => $ct,

            'd1' => $fourthSet['d1'], 'd2' => $fourthSet['d2'], 'd3' => $fourthSet['d3'],
            'd4' => $fourthSet['d4'], 'd5' => $fourthSet['d5'], 'dT' => $dt,

            'Average' => $average
        ];

        if ($this->db->table('evaluation')->insert($dbData)) {
            return $this->db->insertID();
        }
        return false;
    }

    public function UpdatingEvaluation($data) {
        $info = $data['info'];
        $firstSet = $data['firstSet'];
        $secondSet = $data['secondSet'];
        $thirdSet = $data['thirdSet'];
        $fourthSet = $data['fourthSet'];
    
        $at = $this->CalculateAverage($firstSet);
        $bt = $this->CalculateAverage($secondSet);
        $ct = $this->CalculateAverage($thirdSet);
        $dt = $this->CalculateAverage($fourthSet);
        $average = ($at + $bt + $ct + $dt) / 4 . '%';
    
        $dbData = [
            'Date' => $info['date'],
            'Lesson' => $info['lesson'],
            'Remarks' => $info['remarks'],
    
            'a1' => $firstSet['a1'], 'a2' => $firstSet['a2'], 'a3' => $firstSet['a3'],
            'a4' => $firstSet['a4'], 'a5' => $firstSet['a5'], 'aT' => $at,
    
            'b1' => $secondSet['b1'], 'b2' => $secondSet['b2'], 'b3' => $secondSet['b3'],
            'b4' => $secondSet['b4'], 'b5' => $secondSet['b5'], 'bT' => $bt,
    
            'c1' => $thirdSet['c1'], 'c2' => $thirdSet['c2'], 'c3' => $thirdSet['c3'],
            'c4' => $thirdSet['c4'], 'c5' => $thirdSet['c5'], 'cT' => $ct,
    
            'd1' => $fourthSet['d1'], 'd2' => $fourthSet['d2'], 'd3' => $fourthSet['d3'],
            'd4' => $fourthSet['d4'], 'd5' => $fourthSet['d5'], 'dT' => $dt,
    
            'Average' => $average
        ];
    
        $id = $info['id']; 
    
        if ($this->db->table('evaluation')->where('ID', $id)->update($dbData)) {
            return true; 
        }
        return false; 
    }    

    private function CalculateAverage($set) {
        $total = array_sum($set);
        return ($total / 25) * 100; 
    }

    public function DeletionEvaluation($ID) {
        $query = "DELETE FROM evaluation WHERE ID = $ID";
        return $this->db->query($query);
    }

}
