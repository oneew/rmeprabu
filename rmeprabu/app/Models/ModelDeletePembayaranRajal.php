<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelDeletePembayaranRajal extends Model
{

    protected $table      = 'log_delete_transaksi_kasir_rawatjalan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'referencenumber', 'registernumber', 'bpjs_sep', 'pasienid', 'pasienname', 'pasiengender', 'pasiendateofbirth', 'pasienaddress',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'poliklinik', 'poliklinikname', 'code', 'description', 'smf', 'smfname', 'dokter', 'doktername', 'employee', 'employeename',
        'classroom', 'classroomname', 'reasoncode', 'statuspasien', 'totaldaftar', 'totaltindakan', 'totalbhp', 'totalitembhp', 'totalfarmasi', 'totalpenunjang', 'kasirpenunjang', 'subtotal',
        'disc', 'totaldiscount', 'grandtotal', 'paymentamount', 'memo', 'locationcode', 'locationname', 'penunjang', 'cancelby', 'canceldate', 'numberseq', 'createdby', 'createddate',
        'modifiedby', 'modifieddate', 'paymentchange', 'paymentchangenumber', 'payersname', 'paymentstatus', 'created_at', 'updated_at', 'metodepembayaran', 'referensibank', 'nominaldebet', 'noreferensidebet', 'alasanBatal'
    ];
}
