<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelSuratPesananHeader extends Model
{

    protected $table      = 'transaksi_farmasi_suratpesan_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'destinationcode', 'destinationname', 'documentdate', 'documentyear', 'locationcode', 'locationname', 'qtyrequest', 'qtydistribusi', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at', 'keterangan', 'destinationaddress'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function ambildataDSP()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSP($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

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
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataDDA()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDDA($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDFPR()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'RI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDFPR($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('groups', 'RI');
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDFIGD()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDFIGD($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('groups', 'IGD');
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDFRJ()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('qtylayan >', 0);
        $this->dt->like('groups', 'RJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDFRJ($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('qtylayan >', 0);
        $this->dt->like('groups', 'RJ');
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDFPROK()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', 'DEPOOK');
        $this->dt->like('groups', 'RI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDFPROK($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('groups', 'RI');
        $this->dt->where('locationcode', 'DEPOOK');
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataDFPRTN()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));

        $this->dt->like('groups', 'TN');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDFPRTN($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('groups', 'RI');

        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDSPesanan()
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPesanan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesanan_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('locationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
