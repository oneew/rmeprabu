<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelDistribusiHeaderBaksos extends Model
{

    protected $table      = 'transaksi_farmasi_baksos_gudang_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'documentdate', 'documentyear', 'memo', 'locationcode', 'locationname', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at', 'reborn'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function ambildataDSP()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSP($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DSP($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataPermintaan($locationcode)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        //$this->dt->where('destinationcode', $locationcode);
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->where('qtyrequest >', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPermintaan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->where('qtyrequest >', 0);
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('destinationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_permintaan_amprah($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_igdrajal($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_RegisterPermintaan_vitual($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        $this->dt->where('destinationcode', 'VITUAL');
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('destinationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataPermintaanVitual($locationcode)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        //$this->dt->where('destinationcode', $locationcode);
        $this->dt->where('destinationcode', 'VITUAL');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataPermintaanGC($locationcode)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        //$this->dt->where('destinationcode', $locationcode);
        $this->dt->where('destinationcode', 'GASCENTRAL');
        $this->dt->where('qtyrequest >', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPermintaanGC($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        $this->dt->where('destinationcode', 'GASCENTRAL');
        $this->dt->where('qtyrequest >', 0);
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('destinationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataPermintaanKonsinyasi($locationcode)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        //$this->dt->where('destinationcode', $locationcode);
        $this->dt->where('destinationcode', 'KONSINYASI');
        $this->dt->where('qtyrequest >', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPermintaanKonsinyasi($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        $this->dt->where('destinationcode', 'KONSINYASI');
        $this->dt->where('qtyrequest >', 0);
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('destinationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
