<?php

namespace App\Models;

use CodeIgniter\Model;

class Announcement extends Model
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

    public function InsertAnnouncement($name, $uploadData, $title, $post, $date){
        $query = "INSERT INTO announce(Date, Title, Post, Picture, Author) 
        VALUES('$date', '$title', '$post', '$uploadData', '$name')";
        return $this->db->query($query);
    }

    public function deleteAnnouncement($ID){
        $query = "DELETE FROM announce WHERE ID = $ID";
        return $this->db->query($query);
    }

    public function UpdateAnnouncement($id, $title, $post, $newName){
        if($newName){
            $query = "UPDATE announce SET Title = '$title', Post = '$post', Picture = '$newName' WHERE ID = $id";
        }else{
            $query = "UPDATE announce SET Title = '$title', Post = '$post' WHERE ID = $id";
        }
        return $this->db->query($query);
    }
}
