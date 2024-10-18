<?php

namespace App\Models;

use CodeIgniter\Model;

class SupervisorModel extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'supervisor';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['Username', 'Password', 'Name', 'Profile'];

    
}
