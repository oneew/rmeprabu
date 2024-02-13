<?php

namespace App\Models;

use CodeIgniter\Model;

class logactivity extends Model
{
    protected $table = 'logreborn2023activity';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'datelogin', 'datetimelogin', 'locationcode', 'level', 'locationname', 'ip', 'activity', 'pasienid', 'menu'];
}
