<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_signature extends Model
{
	protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    function get_list()
    {
    	$this->dt = $this->db->table('signature');
    	$query=$this->dt->get();
    	return $query->getResultArray();
    }

    function insert_sign($sign)
    {
    	$this->dt = $this->db->table('signature');
    	$this->dt->insert(['signature'=>$sign]);
    }
}