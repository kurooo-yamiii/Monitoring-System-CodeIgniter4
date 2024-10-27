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

    public function AuthenticateUser($username, $password){
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
            $row = $query->getRow();
            if ($row) {
                $result = (array) $row; 
                $result['level'] = 2; 
                return $result;
            }
        }
    }

    private function forStudent($username,$password){
        $builder = $this->db->table($this->table);

        $query = $builder->select('*')
                    ->where('Username', $username)
                    ->where('Password', $password)
                    ->get();
        $row = $query->getRow();
        if ($row) {
            $result = (array) $row; 
            $result['level'] = 0; 
            return $result;
         }
    }

    private function forTeacher($username,$password){
        $builder = $this->db->table('teacher');

        $query = $builder->select('*')
                    ->where('Username', $username)
                    ->where('Password', $password)
                    ->get();
        $row = $query->getRow();
        if ($row) {
            $result = (array) $row; 
            $result['level'] = 1; 
            return $result;
         }
    }

  
}
