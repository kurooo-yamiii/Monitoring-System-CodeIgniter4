<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class Statistic extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllPST(){
        $query = "SELECT * FROM student";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }
	
	public function GetThreeDTR($ID){
		$query = "SELECT * FROM dtr WHERE AccID = $ID ORDER BY ID DESC LIMIT 3";
        $builder = $this->db->query($query);
        return $builder->getResult();
	}

    public function GetAllPSTEvaluation($ID) {
        $query = "SELECT * FROM evaluation WHERE StudentID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }
	
	public function getRecentScores($id){
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
	
	public function getBarScores($id) {
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

    public function GetAllDTR($ID) {
        $query = "SELECT * FROM dtr WHERE AccID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function GetSearchData($search) {
        $query = "SELECT * FROM student WHERE Resource != '' AND (Name LIKE '%$search%' OR Program LIKE '%$search%' OR School LIKE '%$search%' OR Section LIKE '%$search%')";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchByMajor($major) {
        if($major == 'FetchAll'){
            $query = "SELECT * FROM student WHERE Resource IS NOT NULL";
        }else{
            $query = "SELECT * FROM student WHERE Resource IS NOT NULL AND (Program LIKE '%$major%')";
        }
        $builder = $this->db->query($query);
        return $builder->getResult();
    }
}
