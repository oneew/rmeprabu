<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_dokter;
use App\Models\ModelDokter;
use Config\Services;

class dokter extends Controller
{


    public function index()
    {
        echo view('ibs/data_dokter');
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_dokter($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->code;
                $row[] = $list->name;
                $row[] = $list->kode_bpjs;
                $row[] = $list->locationname;
                $row[] = $list->telephone;
                $row[] = $list->handphone;
                $row[] = $list->sip;
                $row[] = $list->tmtsip;
                $row[] = $list->tatsip;
                $row[] = $list->str;
                $data[] = $row;
            }

            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $m_icd->count_all(),
                "recordsFiltered" => $m_icd->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'data' => view('ibs/modaltambahdokter')
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function smf()
    {

        $m_auto = new ModelDokter();
        $list = $m_auto->get_list_poli();
        return $list;
    }
}
