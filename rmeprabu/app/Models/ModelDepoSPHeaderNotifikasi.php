<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelDepoSPHeaderNotifikasi extends Model
{

    protected $table      = 'transaksi_farmasi_deposp_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'destinationcode', 'destinationname', 'documentdate', 'documentyear', 'locationcode', 'locationname', 'qtyrequest', 'qtydistribusi', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function ambildataDSP()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSP($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
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
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPesanan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_header');

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

    function SPheader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function depoSPdetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function SPheaderdetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataDDB()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDDB($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDDB_ekspor($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'FARMASI');
        //$this->dt->like('journalnumber', $search['nomorpesanan']);
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('referencelocationcode', $search['locationcode']);
        // }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDSPGasCentral()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'GASCENTRAL');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPGasCentral($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('destinationcode', 'GASCENTRAL');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataDDBGC()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', 'GASCENTRAL');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDDBGC($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'GASCENTRAL');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDSPNonAcc()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->where('qtydistribusi', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPNonAcc($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->where('qtydistribusi', 0);
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDSPKonsinyasi()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'KONSINYASI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPKonsinyasi($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('destinationcode', 'KONSINYASI');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cek_distribusi()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->select('locationname, qtyrequest');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'FARMASI');
        $this->dt->where('qtydistribusi', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDSPHibah()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'HIBAH');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDSPHibah($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('destinationcode', 'HIBAH');
        $this->dt->like('journalnumber', $search['nomorpesanan']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cek_distribusi_hibah()
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->select('locationname, qtyrequest');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('destinationcode', 'HIBAH');
        $this->dt->where('qtydistribusi', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
