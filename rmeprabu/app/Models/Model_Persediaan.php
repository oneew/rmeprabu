<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class Model_Persediaan extends Model
{


    protected $table      = 'obat';
    protected $primaryKey = 'id';



    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildataobat()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code');
        $this->dt->orderBy('obat.name', 'ASC');
        $this->dt->notlike('obat.code', 'NONE');
        $this->dt->where('obat.inactive', 'TIDAK');
        $this->dt->groupBy('obat.name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    private function _filter_persediaan($search)
    {
        if ($search != null) {
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
        }
    }

    private function _filter_stock_awal($search)
    {
        if ($search != null) {
            $this->dt->where('dari', $search['sebelum']);
        }
    }


    function penambahan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->select('code , qty , price, purchaseprice');
        $this->_filter_persediaan($search);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function pengurangan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->select('code , qty , price');
        $this->_filter_persediaan($search);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ed()
    {
        $this->dt = $this->db->table('obat_balance');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function saldoawal($search)
    {
        $this->dt = $this->db->table('resume_obat_gudang');
        $this->_filter_stock_awal($search);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
