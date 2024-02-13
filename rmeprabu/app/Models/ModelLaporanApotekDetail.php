<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class ModelLaporanApotekDetail extends Model
{
    protected $table      = 'transaksi_farmasi_pelayanan_header';
    protected $primaryKey = 'id';



    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_RegisterRadiologi_today()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('groups', 'RAD');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRadiologi($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'RAD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Radiologi_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , totaltarif , totalbhp , subtotal');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->like('types', 'RAD');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL_today()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('groups', 'ABL');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_ABL_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , totaltarif , totalbhp , subtotal');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->like('types', 'ABL');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'ABL');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS_today()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('groups', 'FRS');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_FRS_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , totaltarif , totalbhp , subtotal');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->like('types', 'FRS');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'FRS');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterApotek_today()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        //$this->dt->where('groups', 'RAD');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Apotek_detail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , subtotal as totaltarif');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterApotek($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        if ($search['apotek'] != "") {
            $this->dt->like('locationcode', $search['apotek']);
        }

        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Apotek_detail_list()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , subtotal as totaltarif, relation as pasienid, relationname as pasienname, paymentmethod, referencenumber');
        $query = $this->dt->where('documentdate', date('Y-m-d'));
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Apotek_detail_list_banyak($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , subtotal as totaltarif, relation as pasienid, relationname as pasienname, paymentmethod, referencenumber');
        $query = $this->dt->where('documentdate >=', $search['mulai']);
        $query = $this->dt->where('documentdate <=', $search['sampai']);
        $query = $this->dt->where('locationcode', $search['apotek']);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
