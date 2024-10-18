<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Password']; 

    public function GetSupervisorUser($UserID) {
		 $query = "SELECT * FROM supervisor WHERE ID = $UserID";
        $builder = $this->db->query($query);
        return $builder->getResult();
	}
	
	 public function UpdateUserProfile($id, $name, $password, $newName){
        if($newName){
            $query = "UPDATE supervisor SET Name = '$name', Password = '$password', Profile = '$newName' WHERE ID = $id";
        }else{
            $query = "UPDATE supervisor SET Name = '$name', Password = '$password' WHERE ID = $id";
        }
        return $this->db->query($query);
    }
	

}
