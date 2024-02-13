<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTerimaNonPBFDetail extends Model
{

    protected $table      = 'transaksi_farmasi_terima_nonpbf_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'relation', 'relationname', 'referencenumber', 'locationcode', 'code', 'name', 'qtybox', 'volume', 'qty', 'uom', 'batchnumber',
        'expireddate', 'disc', 'tax', 'price', 'purchaseprice', 'purchasepricebefore', 'subtotal', 'totaldiscount', 'beforetax', 'taxamount', 'aftertax', 'createdby', 'createddate'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}
