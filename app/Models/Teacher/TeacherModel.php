<?php

namespace App\Models\Teacher;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name', 'Profile'];
}
