<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class Deployment extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetPSTStudents(){
        $query = "SELECT * FROM student WHERE Resource = ''";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function GetCoopTeacher() {
        $query = "SELECT * FROM teacher WHERE Student = 0";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function SearchPST($depstudent){
        $query = "SELECT * FROM student 
        WHERE Resource = '' AND (Name LIKE '%$depstudent%' OR Section LIKE '%$depstudent%' OR Program LIKE '%$depstudent%')";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function searchCOOP($coopteacher) {
        $query = "SELECT * FROM teacher 
        WHERE Student = '' AND (Name LIKE '%$coopteacher%' OR School LIKE '%$coopteacher%' OR Division LIKE '%$coopteacher%')";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function DeployStudentnProfessor($idpst, $idcoop, $name, $school, $division, $grade, $coor) {
        $this->db->transStart();

            $this->db->query("UPDATE teacher SET Student = ? WHERE ID = ?", [$idpst, $idcoop]);

            $this->db->query("UPDATE student SET Resource = ?, Coordinator = ?, Division = ?, Grade = ?, School = ? WHERE ID = ?", [$name, $coor, $division, $grade, $school, $idpst]);

            $this->db->transComplete();
            if ($this->db->transStatus() === FALSE) {
                return false;
            } else {
                return true;
            }
    }
}
