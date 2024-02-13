<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelSODepoHeader extends Model
{

    protected $table      = 'transaksi_farmasi_opname_depo_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'documentyear', 'memo', 'locationcode', 'locationname', 'numberseq',  'createdby', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'created_at', 'updated_at', 'reborn'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function ambildataDTPBF()
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDTPBF($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('ordernumber', $search['nomorpesanan']);
        $this->dt->like('invoicenumber', $search['nomorfaktur'], 'after');
        if ($search['namasupplier'] != "") {
            $this->dt->like('suppliername', $search['namasupplier']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DTPBF($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataDTNonPBF()
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDTNonPBF($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('ordernumber', $search['nomorpesanan']);
        $this->dt->like('invoicenumber', $search['nomorfaktur'], 'after');
        if ($search['namasupplier'] != "") {
            $this->dt->like('suppliername', $search['namasupplier']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataDSO()
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', session()->get('locationcode'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSO($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', session()->get('locationcode'));
        $this->dt->like('memo', $search['catatan']);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
