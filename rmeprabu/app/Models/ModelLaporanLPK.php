<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class ModelLaporanLPK extends Model
{
    protected $table      = 'transaksi_pelayanan_penunjang_header';
    protected $primaryKey = 'id';



    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_RegisterLPK_today()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('groups', 'LPK');
        $this->dt->where('documentdate=', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPK($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'LPK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_LPK_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('journalnumber , documentdate , name , price , qty, relation , totaltarif , totalbhp , subtotal');
        $query = $this->dt->whereIn('journalnumber', $id);
        $query = $this->dt->like('types', 'LPK');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_LPK_detail_Lis($id)
    {
        $this->dt = $this->db->table('order_lab');
        $this->dt->select('no_lab , no_registrasi, waktu_kirim , kode_test, test , Jumlah_test , status');
        $query = $this->dt->whereIn('no_lab', $id);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_LPK_feed_Lis($id)
    {
        $this->dt = $this->db->table('lab_hasil');
        $this->dt->select('no_lab , no_registrasi, no_urut, kode_pemeriksaan, nama_pemeriksaan, unit, normal, hasil, flag, tgl_jam_insert, flag_ambil, tgl_jam_ambil, type, no_rm, tgl_daftar, tgl_hasil, kode_sir');
        $query = $this->dt->whereIn('no_order', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
