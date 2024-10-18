<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{   
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name'];

    public function CallStudent($username, $password){
        if($this->forStudent($username,$password)){
            return $this->forStudent($username,$password);
        }elseif($this->forTeacher($username,$password)){
            return $this->forTeacher($username,$password);
        }else{
            $builder = $this->db->table('supervisor');

            $query = $builder->select('*')
                        ->where('Username', $username)
                        ->where('Password', $password)
                        ->get();
            return $query->getRow();
        }
    }

    private function forStudent($username,$password){
        $builder = $this->db->table($this->table);

        $query = $builder->select('*')
                    ->where('Username', $username)
                    ->where('Password', $password)
                    ->get();
        return $query->getRow();
    }

    private function forTeacher($username,$password){
        $builder = $this->db->table('teacher');

        $query = $builder->select('*')
                    ->where('Username', $username)
                    ->where('Password', $password)
                    ->get();
        return $query->getRow();
    }

  
}
