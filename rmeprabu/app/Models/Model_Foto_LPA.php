<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_Foto_LPA extends Model
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


    public function set_foto($file, $code)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->where('expertiseid', $code);
        $this->dt->update(['fotoradiologi' => $file]);
    }
}
