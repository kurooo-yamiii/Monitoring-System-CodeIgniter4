<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class TeacherProfile extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllProfessorInformation($ID, $studID) {
        $student = $this->FetchStudentName($studID);
        if (empty($student)) {
            return null; 
        }
        $studentName = $student[0]->Name; 
        $query = "SELECT teacher.*, '$studentName' AS StudentName FROM teacher WHERE teacher.ID = $ID";
        $builder = $this->db->query($query);
        
        return $builder->getResult();
    }

    private function FetchStudentName($ID){
        $query = "SELECT Name FROM student WHERE ID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function UpdateUserSignatory($newName, $id){
        $query = "UPDATE teacher SET Signature = '$newName' WHERE ID = $id";
        return $this->db->query($query);
    }

    public function UpdateUserProfile($id, $name, $password, $school, $division, $grade, $coordinator, $newName){
        if($newName){
            $query = "UPDATE teacher SET Name = '$name', Password = '$password', School = '$school', Division = '$division', Grade = '$grade', Coordinator = '$coordinator',  Profile = '$newName' WHERE ID = $id";
        }else{
            $query = "UPDATE teacher SET Name = '$name', Password = '$password' , School = '$school', Division = '$division', Grade = '$grade', Coordinator = '$coordinator' WHERE ID = $id";
        }
        return $this->db->query($query);
    }
}
