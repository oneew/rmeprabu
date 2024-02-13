<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarRadiologiNonRM extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'visited', 'groups', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'registernumber', 'referencenumber',
        'registernumber_rawatjalan', 'registernumber_rawatinap', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber',  'faskes', 'faskesname', 'dokter', 'doktername', 'employee', 'employeename',
        'smf', 'smfname', 'classroom', 'classroomname', 'room', 'roomname', 'locationcode', 'locationname', 'icdx', 'icdxname', 'orderpemeriksaan', 'tgl_order',
        'memo', 'token_radiologi', 'numberseq', 'createdby', 'createddate', 'note', 'status', 'paramedis', 'numberseq'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
