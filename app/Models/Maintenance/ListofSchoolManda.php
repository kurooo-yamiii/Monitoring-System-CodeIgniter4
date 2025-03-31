<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class ListofSchoolManda extends Model
{   
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'school2nd'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'School',    
        'Abbreviation',
    ];

    public function GetListOfSchoolManda(){
        $query = "SELECT * FROM school2nd";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function FetchMandaSchool(){
        $query = "SELECT Abbreviation FROM school2nd";
        $builder = $this->db->query($query);
        return $builder->getResultArray();
    }

    public function GenerateDeployingSchoolManda($school, $abbreviation) {
        $query = "INSERT INTO school2nd(School, Abbreviation) 
               VALUES('$school', '$abbreviation')";
        return $this->db->query($query);
    }

    public function UpdateDeployingSchoolManda($ID, $school, $abbreviation) {
        $query = "UPDATE school2nd SET School = '$school', Abbreviation = '$abbreviation'
                    WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function DeleteDeployingSchoolManda($ID) {
        $query = "DELETE FROM school2nd WHERE ID = $ID";
        return $this->db->query($query);
    }


}
