<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSkdMcu extends Model
{

    protected $table      = 'skd_mcu';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'type',
        'nomor_surat',
        'pasienid',
        'referencenumber',
        'pasienid',
        'keperluan',
        'hasil',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}