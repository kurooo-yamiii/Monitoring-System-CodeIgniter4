<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class SVDashboard extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function getAllStudentTeacher()
    {
        return $this->select('student.Name, student.Resource, student.Program, COALESCE(teacher.School, "") AS School')
                    ->join('teacher', 'student.ID = teacher.Student', 'left')
                    ->findAll();
        
    }

    public function getStudentProgram() {
        $program = [
            'BSE-Math' => 'MTH', 
            'BSE-English' => 'ENG', 
            'BSE-Filipino' => 'FIL', 
            'BSE-Science' => 'SCI', 
            'BSE-Social-Studies' => 'SOC', 
            'BTVTED-VGD' => 'VGD', 
            'BTVTED-CSS' => 'CSS', 
            'BTVTED-Animation' => 'ANI'
        ];
        
        $query = "SELECT Program, COUNT(*) AS count FROM student WHERE Program IN ('" . implode("','", array_keys($program)) . "') GROUP BY Program";
        $builder = $this->db->query($query);
        $results = $builder->getResult();
        
        // Map the results to their abbreviations
        $abbreviatedResults = array_fill_keys(array_values($program), 0);
        foreach ($results as $result) {
            $abbreviation = $program[$result->Program] ?? 0;
            if ($abbreviation) {
                $abbreviatedResults[$abbreviation] = $result->count;
            }
        }
        
        return $abbreviatedResults;
    }

    public function getMandaCoop() {
        $schools = [
            'Andres Bonifacio Integrated School' => 'AB1',
            'City of Mandaluyong Science High School' => 'CMS',
            'Eulogio Rodriguez Integrated School' => 'ERI',
            'Highway Hills Integrated School' => 'HHS',
            'Hulo Integrated School' => 'HIS',
            'Ilaya Barangka Integrated School' => 'IBS',
            'Isaac Lopez Integrated School' => 'ILS',
            'Jose Fabella Memorial School' => 'JFM',
            'Manggahan High School' => 'MHS',
            'Mataas na Paaralang Neptali A. Gonzales' => 'MPG',
            'Rizal Technological University' => 'RTU'
        ];

        $query = "SELECT School, COUNT(*) AS count FROM teacher WHERE School IN ('" . implode("','", array_keys($schools)) . "') GROUP BY School"; 
        $builder = $this->db->query($query);
        $results = $builder->getResult();

        $abbreviatedResults = array_fill_keys(array_values($schools), 0);
        foreach ($results as $result) {
            $abbreviation = $schools[$result->School] ?? 0;
            if ($abbreviation) {
                $abbreviatedResults[$abbreviation] = $result->count;
            }
        }
        return $abbreviatedResults;
    }

    public function getPasigCoop() {
        $schools = [
            'Eusebio High School' => 'EHS',
            'Mandaluyong High School' => 'MHS',
            'Nagpayong High School' => 'NHS',
            'Pinagbuhatan High School' => 'PHS',
            'Rizal Experimental Station and Pilot School' => 'REPS',
            'Rizal High School' => 'RHS',
            'Sagad High School' => 'SHS',
            'San Joaquin-Kalawaan High School' => 'SJK',
            'Santolan High School' => 'SH',
            'Sta. Lucia High School' => 'SLS'
        ];

        $abbreviatedResults = array_fill_keys(array_values($schools), 0);
        $query = "SELECT School, COUNT(*) AS count FROM teacher WHERE School IN ('" . implode("','", array_keys($schools)) . "') GROUP BY School"; 
        $builder = $this->db->query($query);
        $results = $builder->getResult();
        
        foreach ($results as $result) {
            $abbreviation = $schools[$result->School] ?? null; 
            if ($abbreviation) {
                $abbreviatedResults[$abbreviation] = $result->count; 
            }
        }
        
        return $abbreviatedResults;
    }

    public function standByDeploy(){
        $query = " SELECT 
                SUM(CASE WHEN School IS NULL OR School = '' THEN 1 ELSE 0 END) AS null_count,
                SUM(CASE WHEN School IS NOT NULL AND School != '' THEN 1 ELSE 0 END) AS non_null_count
                FROM student
                 ";
        
        $builder = $this->db->query($query);
        $result = $builder->getRow();
        
        $totalNull = $result->null_count;
        $totalNonNull = $result->non_null_count;
        
        return [
            'StandBy' => $totalNull,
            'Deploy' => $totalNonNull
        ];
    }

    public function fetchRecentDep() {
        $query = "SELECT * FROM student WHERE Resource !='' ORDER BY ID DESC LIMIT 3";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

}
