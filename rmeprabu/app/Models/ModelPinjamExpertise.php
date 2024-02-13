
<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPinjamExpertise extends Model
{

    protected $table      = 'tracing_pinjam_foto_radiologi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'expertiseid', 'pinjamdate', 'asalpeminjam', 'peminjamname', 'statuspinjam', 'created_at', 'updated_at', 'createdby', 'updated_by',
        'kembalidate', 'pengembaliname', 'pacsnumber'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
