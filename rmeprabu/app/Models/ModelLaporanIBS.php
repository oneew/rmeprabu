<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class ModelLaporanIBS extends Model
{
    protected $table      = 'transaksi_pelayanan_rawatinap_operasi_header';
    protected $primaryKey = 'id';



    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_RegisterIBS_today()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        if ($search['smf'] != "") {
            $this->dt->like('smfname', $search['smf']);
        }
        if ($search['dokter'] != "") {
            $this->dt->like('ibsdoktername', $search['dokter']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_IBS_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , totaltarif , totalbhp , subtotal');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
