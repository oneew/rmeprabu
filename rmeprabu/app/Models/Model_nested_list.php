<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_nested_list extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    function get_master()
    {
        //$this->dt=$this->db->table('nested_list_master');
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $query = $this->dt->where('groups', 'RAD');
        $query = $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_detail($id)
    {
        //$this->dt=$this->db->table('nested_list_detail');
        //$this->dt->whereIn('id_master', $id);
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->whereIn('journalnumber', $id);
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
