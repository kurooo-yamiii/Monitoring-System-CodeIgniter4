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
        $query = "SELECT * FROM evaluation WHERE StudentID = ?";
        $builder = $this->db->query($query, [$ID]);
        return $builder->getResult();
    }

    public function OrganizeTableEvaluation($ID) {
        $query = "
        SELECT 'Conciseness' AS Variable, a1 AS Q1, a2 AS Q2, a3 AS Q3, a4 AS Q4, a5 AS Q5, aT AS Total FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Clearness', b1, b2, b3, b4, b5, bT FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Clarity', c1, c2, c3, c4, c5, cT FROM evaluation WHERE ID = ?
        UNION ALL 
        SELECT 'Correctness', d1, d2, d3, d4, d5, dT FROM evaluation WHERE ID = ? 
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
}
