<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTNOHeaderRajal extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatjalan_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'examination', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname',
        'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname', 'paymentmethod', 'paymentmethodname',
        'paymentcardnumber', 'poliklinik', 'poliklinikname', 'smf', 'smfname', 'employee', 'employeename', 'dokter', 'doktername', 'locationcode', 'locationname', 'validation', 'validationby',
        'validationdate', 'numberseq', 'createdby', 'createddate', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
