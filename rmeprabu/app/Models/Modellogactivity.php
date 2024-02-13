<?php

namespace App\Models;

use CodeIgniter\Model;

class Modellogactivity extends Model
{
    protected $table = 'logreborn2023activity';
    protected $primaryKey = 'id';
    protected $allowedFields = ['firstname', 'lastname', 'email', 'dateactivity', 'datetimeactivity', 'locationcode', 'level', 'locationname', 'ip', 'activity', 'pasienid', 'menu'];
}
