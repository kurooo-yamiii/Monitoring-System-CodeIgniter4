<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentAnnouncement extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table = 'announce'; 
    protected $primaryKey = 'ID';   
    protected $allowedFields = [
        'Date',    
        'Title',
        'Post',
        'Author',  
        'Picture'
    ];

    public function GetAllAnnouncement(){
        $query = "SELECT * FROM announce";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }
}
