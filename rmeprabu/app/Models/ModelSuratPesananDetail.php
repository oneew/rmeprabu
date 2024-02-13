<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelSuratPesananDetail extends Model
{

    protected $table      = 'transaksi_farmasi_suratpesan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'destinationcode', 'locationcode', 'code', 'name', 'qty', 'uom', 'qtystock', 'qtydistribusi', 'createdby', 'createddate',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
