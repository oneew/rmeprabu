<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_dokter_gallery extends Model
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

    // melakukan select terhadap seluruh record yang types nya dokter
    function get_list_dokter()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id , code , foto , locationname, telephone, address');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('memo', '');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    //  sudah tidak dipakai
    public function get_foto($code)
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->select(' foto ');
        $this->dt->where('code', $code);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    // mengganti nilai foto dalam db
    public function set_foto($file, $code)
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->where('code', $code);
        $this->dt->update(['foto' => $file]);
    }
}
