<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelDistribusiDetail extends Model
{

    protected $table      = 'transaksi_farmasi_distribusi_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'referencenumber', 'referencelocationcode', 'referencelocationname', 'locationcode', 'locationname', 'code', 'name', 'batchnumber',
        'expireddate', 'qtyrequest', 'qty', 'uom', 'price', 'subtotal', 'createdby', 'createddate', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
