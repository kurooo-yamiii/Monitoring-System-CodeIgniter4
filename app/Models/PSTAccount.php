<?php

namespace App\Models;

use CodeIgniter\Model;

class PSTAccount extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function getPSTAccount(){
        $query = "SELECT * FROM student";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function insertStudent($data) {
        $query = "INSERT INTO student(Username, Password, Name, Program, Section, Supervisor, Contact, Total, Coordinator, School, Resource, Division, Grade, Profile, EvalID) 
               VALUES('$data[1]', '123456789', '$data[2]', '$data[4]', '$data[5]', '$data[0]', '$data[3]', '', '', '', '', '', '','','')";
        return $this->db->query($query);
    }

    public function deleteStudent($ID) {
        $query = "DELETE FROM student WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function resetPassword($ID) {
        $query = "UPDATE student SET Password = 12345678 WHERE ID = $ID";
        return $this->db->query($query);
    }

}
