<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_Foto_Users extends Model
{

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
        $this->dt = $this->db->table('users');
        $this->dt->where('email', $code);
        $this->dt->update(['foto' => $file]);
    }
}
