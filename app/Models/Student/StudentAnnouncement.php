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

    public function LikeStatusManipulate($id, $userId) {

        $query = "SELECT * FROM announce WHERE ID = $id";
        $builder = $this->db->query($query);
        $announcement = $builder->getRow(); 
    
        if (!$announcement) {
            return 0; 
        }
    
        $likes = !empty($announcement->LikeID) ? explode(',', $announcement->LikeID) : [];
    
        if (in_array($userId, $likes)) {
            $likes = array_diff($likes, [$userId]); 
        } else {
            $likes[] = $userId; 
        }
    
        $likesString = implode(',', $likes);
        $query = "UPDATE announce SET LikeID = '$likesString' WHERE ID = $id";
        $this->db->query($query); 
    
        return count($likes); 
    }
}
