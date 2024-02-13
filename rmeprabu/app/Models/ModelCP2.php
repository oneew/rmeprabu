<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ModelCP2 extends Model
{

    //protected $table = "transaksi_pelayanan_rawatinap_operasi_header2";
    protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
    }


    function get_list_penunjang($key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->distinct('name');
        $this->dt->orderBy('id');
        $this->dt->groupBy('name');
        $this->dt->like('name', $key);
        $this->dt->limit(15);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tindakan($key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->distinct('name');
        $this->dt->orderBy('id');
        $this->dt->groupBy('name');
        $this->dt->like('name', $key);
        $this->dt->limit(15);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_obat($key)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->distinct('name');
        $this->dt->orderBy('id');
        $this->dt->groupBy('name');
        $this->dt->like('name', $key);
        $this->dt->limit(15);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
