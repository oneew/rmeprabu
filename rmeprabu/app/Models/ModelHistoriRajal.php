<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelHistoriRajal extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatjalan';
    protected $primaryKey = 'id';


    function search_RegisterRajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienid', $search['filter']);
        $this->dt->like('groups', 'IRJ');
        $this->dt->like('poliklinikname', 'REHAB MEDIK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
