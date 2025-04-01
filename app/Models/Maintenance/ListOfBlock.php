<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class ListOfBlock extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'block'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'Section',    
        'Branch',
    ];

    public function GetListofBlock(){
        $query = "SELECT * FROM block";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function CheckExistingSection($section) {
        $query = "SELECT * FROM block WHERE Section = ?";
        $builder = $this->db->query($query, [$section]);
        return $builder->getNumRows() > 0;
    }

    public function GenerateNewSection($section, $branch) {
        $query = "INSERT INTO block(Section, Branch) 
               VALUES('$section', '$branch')";
        return $this->db->query($query);
    }

    public function UpdateSchoolGrade($ID, $section, $branch) {
        $query = "UPDATE block SET Section = '$section', Branch = '$branch'
                    WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function DeleteSection($ID) {
        $query = "DELETE FROM block WHERE ID = $ID";
        return $this->db->query($query);
    }

}
