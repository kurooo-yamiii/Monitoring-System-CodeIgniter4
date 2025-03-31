<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class ListOfSchoolPasig extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'school1st'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'School',    
        'Abbreviation',
    ];

    public function GetListOfSchoolPasig(){
        $query = "SELECT * FROM school1st";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchDeployedAbbreviationPasig(){
        $query = "SELECT Abbreviation FROM school1st";
        $builder = $this->db->query($query);
        return $builder->getResultArray();
    }

    public function GenerateDeployingSchoolPasig($school, $abbreviation) {
        $query = "INSERT INTO school1st(School, Abbreviation) 
               VALUES('$school', '$abbreviation')";
        return $this->db->query($query);
    }

    public function UpdateDeployingSchoolPasig($ID, $school, $abbreviation) {
        $query = "UPDATE school1st SET School = '$school', Abbreviation = '$abbreviation'
                    WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function DeleteDeployingSchoolPasig($ID) {
        $query = "DELETE FROM school1st WHERE ID = $ID";
        return $this->db->query($query);
    }
}
