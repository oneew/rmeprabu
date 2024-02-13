<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_dakurajal extends Model
{

    protected $table = "transaksi_pelayanan_daftar_rawatjalan";
    protected $column_order = array('id', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'poliklinikname', 'doktername', 'statuspasien');
    protected $column_search = array('id', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'poliklinikname', 'doktername', 'statuspasien');
    protected $order = array('id' => 'ASC');
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

    private function _get_datatables_query()
    {
        $this->dt = $this->db->table($this->table);
        if ($this->request->getPost('norm') != "") {
            $this->dt->like('pasienid', $this->request->getPost('norm'));
        }
        if ($this->request->getPost('smf') != "") {
            $this->dt->like('paymentmethodname', $this->request->getPost('smf'));
        }
        if ($this->request->getPost('poliklinikname') != "") {
            $this->dt->like('poliklinikname', $this->request->getPost('poliklinikname'));
        }





        if ($this->request->getPost('start_date') && $this->request->getPost('end_date')) {

            $awal = $this->request->getPost('start_date');
            $akhir = $this->request->getPost('end_date');

            $mulai = str_replace('/', '-', $awal);
            $sampai = str_replace('/', '-', $akhir);

            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            //$tgl_mulai = date('Y-m-d', strtotime($mulai));
            //$tgl_sampai = date('Y-m-d', strtotime($sampai));





            //$start_date = date('Y-m-d', strtotime($this->request->getPost("start_date")));
            //$end_date = date('Y-m-d', strtotime($this->request->getPost("end_date")));

            $start_date = date('Y-m-d', strtotime($mulai));
            $end_date = date('Y-m-d', strtotime($sampai));
            $this->dt->where('documentdate >=', $start_date);
            $this->dt->where('documentdate <=', $end_date);
        } else {
            $this->dt->where('documentdate >=', date('Y-m-d'));
            $this->dt->where('documentdate <=', date('Y-m-d'));
        }




        $this->dt->like('groups', 'IRJ');


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
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
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

    function get_data_pasien($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table('pasien');

        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}