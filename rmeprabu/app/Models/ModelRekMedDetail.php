<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRekMedDetail extends Model
{

    protected $table      = 'transaksi_rekammedik_rawatjalan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'poliklinik', 'poliklinikname', 'smf', 'smfname', 'dokter', 'doktername',
        'referencenumber', 'referencenumber_rawatinap', 'locationcode', 'coding', 'codeicdx', 'nameicdx', 'codeicdix', 'nameicdix', 'memo', 'createdby', 'createddate', 'paymentchange',
        'paymentchangenumber', 'kategori', 'created_at', 'updated_at', 'date_pelayanan', 'pasiengender', 'age_years', 'age_months', 'age_days'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
