<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDisabilitasMcu extends Model
{

    protected $table      = 'disabilitas_mcu';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nomor_surat',
        'referencenumber',
        'pasienid',
        'amputasi',
        'lumpuh',
        'paraplegi',
        'deformitas',
        'buta_total',
        'persepsi_cahaya',
        'rungu',
        'wicara',
        'disabilitas_grahita',
        'down_syndrome',
        'psikososial',
        'disabilitas_perkembangan',
        'derajat_disabilitas',
        'penyebab',
        'alat_bantu',
        'keperluan',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}