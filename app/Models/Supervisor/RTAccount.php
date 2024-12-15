<?php

namespace App\Models\Supervisor;

use CodeIgniter\Model;

class RTAccount extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function getTeacherAcc(){
        $query = "SELECT * FROM teacher";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchAllSchool(){
        $query = "SELECT School, Abbreviation, 'PASIG' AS Branch
            FROM school1st
            UNION
            SELECT School, Abbreviation, 'MANDALUYONG' AS Branch
            FROM school2nd";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchAllDivision() {
        $query = "SELECT * FROM division";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchAllGrade() {
        $query = "SELECT * FROM grade";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function insertProfessor($data) {
        $query = "INSERT INTO teacher(Username, Password, Name, Student, School, Division, Grade, Coordinator, Profile) 
               VALUES('$data[1]', '123456789', '$data[2]', '', '$data[4]', '$data[5]', '$data[0]', '$data[3]','')";
        return $this->db->query($query);
    }

    public function deleteProfessor($ID) {
        $query = "DELETE FROM teacher WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function resetPassword($ID) {
        $query = "UPDATE teacher SET Password = 12345678 WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function CheckExistingRT($email) {
        $query = "SELECT * FROM teacher WHERE Username = ?";
        $builder = $this->db->query($query, [$email]);
        return $builder->getNumRows() > 0;
    }

}
