<?php

namespace App\Models\Student;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name', 'Profile'];

}
