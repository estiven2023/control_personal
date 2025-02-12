<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employees';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'email', 'position'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}

