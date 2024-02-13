<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelBayarTindakanRajal extends Model
{

    protected $table      = 'transaksi_pembayaran_tindakan_rajal';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'doktername', 'subtotal', 'paymentamount', 'created_at', 'createdby'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    function get_pembayaran_tindakan_rajal($referencenumber)
    {
        $tb = "transaksi_pembayaran_tindakan_rajal";
        $this->dt = $this->db->table($tb);
        $this->dt->where('referencenumber', $referencenumber);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
