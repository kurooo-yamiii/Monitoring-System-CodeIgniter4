<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentProfile extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllStudentInformation($ID) {
        $query = "SELECT * FROM student WHERE ID = $ID";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function UpdateUserProfile($id, $name, $password, $program, $section, $contact, $newName){
        if($newName){
            $query = "UPDATE student SET Name = '$name', Password = '$password', Program = '$program', Section = '$section', Contact = '$contact',  Profile = '$newName' WHERE ID = $id";
        }else{
            $query = "UPDATE student SET Name = '$name', Password = '$password' , Program = '$program', Section = '$section', Contact = '$contact' WHERE ID = $id";
        }
        return $this->db->query($query);
    }
	
}
