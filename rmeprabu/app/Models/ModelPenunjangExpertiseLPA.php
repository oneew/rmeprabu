<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenunjangExpertiseLPA extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_expertise_lpa';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups',
        'employee',
        'employeename',
        'id_penunjang_detail',
        'makroskopis',
        'mikroskopis',
        'kesan',

        'kelainan_sitologis',
        'kualitas_smear',
        'interpretasi',
        'endocervix',
        'reaktif',
        'infeksi',
        'evaluasi',
        'asc_data',
        'lis',
        'ssc',
        'nos',
        'atipik',
        'ais',
        'adenocarcinoma',
        'kesimpulan',
        'saran',

        'created_by',
        'updated_at',
        'updated_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
