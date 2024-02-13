<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelReturPBFHeader extends Model
{

    protected $table      = 'transaksi_farmasi_retur_pbf_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'documentyear', 'supplier', 'suppliername', 'supplieraddress', 'memo',  'locationcode', 'locationname', 'numberseq', 'createdby', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function ambildataDTPBF()
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(200);
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
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(200);
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

        $this->dt->limit(400);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_faktur($id)
    {
        $tb = "transaksi_farmasi_terima_pbf_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
