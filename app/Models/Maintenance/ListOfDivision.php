<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class ListOfDivision extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'division'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'Type',    
        'Division',
    ];

    public function GetListofDivision(){
        $query = "SELECT * FROM division";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function CheckExistingDivision($division) {
        $query = "SELECT * FROM division WHERE Division = ?";
        $builder = $this->db->query($query, [$division]);
        return $builder->getNumRows() > 0;
    }

    public function GenerateNewDivision($division, $type) {
        $query = "INSERT INTO division(Division, Type) 
               VALUES('$division', '$type')";
        return $this->db->query($query);
    }

    public function UpdateSchoolDivision($ID, $division, $type) {
        $query = "UPDATE division SET Division = '$division', Type = '$type'
                    WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function DeleteDivision($ID) {
        $query = "DELETE FROM division WHERE ID = $ID";
        return $this->db->query($query);
    }

}
