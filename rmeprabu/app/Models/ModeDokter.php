<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDokter extends Model
{

    protected $table      = 'dokter';
    protected $primaryKey = 'id';



    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
