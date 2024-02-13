<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTerimaNonPBFHeader extends Model
{

    protected $table      = 'transaksi_farmasi_terima_nonpbf_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'documentyear', 'supplier', 'suppliername', 'supplieraddress', 'invoicenumber', 'invoicedate', 'receiptdate', 'ordernumber', 'orderdate',
        'locationcode', 'locationname', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
