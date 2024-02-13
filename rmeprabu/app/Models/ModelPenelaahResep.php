<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenelaahResep extends Model
{

    protected $table      = 'petugas_resep';
    protected $primaryKey = 'id';

    protected $allowedFields = ['code', 'name', 'address', 'telephone', 'nip', 'handphone'];
}
