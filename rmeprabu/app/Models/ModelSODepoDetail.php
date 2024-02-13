<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSODepoDetail extends Model
{

    protected $table      = 'transaksi_farmasi_opname_depo_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'referencenumber', 'locationcode', 'code', 'name', 'stockqty', 'realqty', 'qty', 'uom', 'batchnumber',
        'expireddate', 'price', 'subtotal', 'createdby', 'createddate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_detail_terima_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_terima_non_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
