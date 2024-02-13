<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ModelPasienFRS extends Model
{

    protected $table = "transaksi_pelayanan_penunjang_header";
    protected $column_order = array('id', 'journalnumber', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'doktername', 'note');
    protected $column_search = array('journalnumber', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'doktername', 'note');
    protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;



    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    public function _get_datatables_query()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('groups', 'FRS');


        if ($this->request->getPost('norm')) {
            $this->dt->like('pasienid', $this->request->getPost('norm'));
        }
        if ($this->request->getPost('smf')) {
            $this->dt->like('smfname', $this->request->getPost('smf'));
        }
        if ($this->request->getPost('start_date') && $this->request->getPost('end_date')) {

            $start_date = date('Y-m-d', strtotime($this->request->getPost("start_date")));
            $end_date = date('Y-m-d', strtotime($this->request->getPost("end_date")));

            $this->dt->where('documentdate >=', $start_date);
            $this->dt->where('documentdate <=', $end_date);
        }
        $this->dt->limit(10);




        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy(
                $this->column_order[$this->request->getPost('order')['0']['column']],
                $this->request->getPost('order')['0']['dir']
            );
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}
