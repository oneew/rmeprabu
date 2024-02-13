<?php

namespace App\Models;

use CodeIgniter\Model;

class logmasuk extends Model
{
    protected $table = 'logreborn2023';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'datelogin', 'datetimelogin', 'locationcode', 'level', 'locationname', 'ip'];
}
