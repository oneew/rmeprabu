<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRekMedHeader extends Model
{

    protected $table      = 'transaksi_rekammedik_rawatjalan_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'referencenumber', 'referencenumber_rawatjalan', 'referencenumber_rawatinap', 'bpjs_sep', 'no_antrian',
        'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname', 'paymentmethod',
        'paymentmethodname', 'paymentcardnumber', 'poliklinik', 'poliklinikname', 'pasienclassroom', 'classroom', 'classroomname', 'bednumber', 'smf', 'smfname', 'dokter', 'doktername',
        'inacbgs', 'inacbgsname', 'locationcode', 'locationname', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'registernumber', 'paymentchange', 'paymentchangenumber',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
