<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class TeacherDashboard extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function StudentRecentScores($id){
		$scores = [];
        $query = "SELECT REPLACE(Average, '%', '') as cleaned_score FROM evaluation WHERE StudentID = $id ORDER BY ID DESC LIMIT 6";
		$builder = $this->db->query($query);
		$result = $builder->getResultArray();
		if (!empty($result)) {
			foreach ($result as $datarow) {
				$scores[] = $datarow['cleaned_score'];
			}
			} else {
				$scores = [0]; 
			}
		return array_reverse($scores);
	}

    public function StudentBarScores($id) {
		$scores = [];
        $query = "SELECT REPLACE(aT, '%', '') as aT, 
                          REPLACE(bT, '%', '') as bT, 
                          REPLACE(cT, '%', '') as cT, 
                          REPLACE(dT, '%', '') as dT 
                  FROM evaluation 
                  WHERE StudentID = $id
                  ORDER BY ID DESC 
                  LIMIT 3";

        $builder = $this->db->query($query);
        $result = $builder->getResultArray();

        if (!empty($result)) {
            foreach ($result as $datarow) {
                $scores['aT'][] = $datarow['aT'];
                $scores['bT'][] = $datarow['bT'];
                $scores['cT'][] = $datarow['cT'];
                $scores['dT'][] = $datarow['dT'];
            }
        } else {
            $scores = [
                'aT' => [0],
                'bT' => [0],
                'cT' => [0],
                'dT' => [0],
            ];
        }
        return $scores;
	}

    public function StudentRecentDTR($ID){
		$query = "SELECT * FROM dtr WHERE AccID = $ID ORDER BY ID DESC LIMIT 3";
        $builder = $this->db->query($query);
        return $builder->getResult();
	}
}
